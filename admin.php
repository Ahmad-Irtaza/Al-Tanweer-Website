<?php
require_once 'functions/auth.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
$action = isset($_GET['action']) ? $_GET['action'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $page === 'login') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    
    if (login($username, $password)) {
        header('Location: admin.php');
        exit;
    } else {
        $loginError = 'Invalid username or password';
    }
}

if ($page === 'logout') {
    logout();
}

if ($page !== 'login' && !isLoggedIn()) {
    header('Location: admin.php?page=login');
    exit;
}

$db = getDatabase();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    switch ($page) {
        case 'products':
            if ($action === 'add' || $action === 'edit') {
                $name = trim($_POST['name'] ?? '');
                $category = trim($_POST['category'] ?? '');
                $description = trim($_POST['description'] ?? '');
                $featured = isset($_POST['featured']) ? 1 : 0;
                $specs = [];
                if (!empty($_POST['spec_keys']) && !empty($_POST['spec_values'])) {
                    foreach ($_POST['spec_keys'] as $i => $key) {
                        if (!empty($key) && isset($_POST['spec_values'][$i])) {
                            $specs[$key] = $_POST['spec_values'][$i];
                        }
                    }
                }
                $specs_json = json_encode($specs);
                
                $image_path = $_POST['existing_image'] ?? '';
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = 'uploads/products/';
                    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                    if (in_array($ext, $allowed)) {
                        $filename = uniqid('prod_') . '.' . $ext;
                        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $filename)) {
                            $image_path = $uploadDir . $filename;
                        }
                    }
                }
                
                if ($action === 'add') {
                    $stmt = $db->prepare("INSERT INTO products (name, category, description, image_path, specifications_json, featured) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$name, $category, $description, $image_path, $specs_json, $featured]);
                    $successMsg = 'Product added successfully!';
                } else {
                    $id = (int)$_POST['id'];
                    $stmt = $db->prepare("UPDATE products SET name = ?, category = ?, description = ?, image_path = ?, specifications_json = ?, featured = ? WHERE id = ?");
                    $stmt->execute([$name, $category, $description, $image_path, $specs_json, $featured, $id]);
                    $successMsg = 'Product updated successfully!';
                }
            } elseif ($action === 'delete') {
                $id = (int)$_POST['id'];
                $stmt = $db->prepare("DELETE FROM products WHERE id = ?");
                $stmt->execute([$id]);
                $successMsg = 'Product deleted successfully!';
            }
            break;
            
        case 'slides':
            if ($action === 'add' || $action === 'edit') {
                $title = trim($_POST['title'] ?? '');
                $subtitle = trim($_POST['subtitle'] ?? '');
                $button_text = trim($_POST['button_text'] ?? '');
                $button_link = trim($_POST['button_link'] ?? '');
                $sort_order = (int)($_POST['sort_order'] ?? 0);
                $active = isset($_POST['active']) ? 1 : 0;
                
                $image_path = $_POST['existing_image'] ?? '';
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = 'uploads/slides/';
                    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                    $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                    if (in_array($ext, $allowed)) {
                        $filename = uniqid('slide_') . '.' . $ext;
                        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $filename)) {
                            $image_path = $uploadDir . $filename;
                        }
                    }
                }
                
                if ($action === 'add') {
                    $stmt = $db->prepare("INSERT INTO slides (title, subtitle, image_path, button_text, button_link, sort_order, active) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$title, $subtitle, $image_path, $button_text, $button_link, $sort_order, $active]);
                    $successMsg = 'Slide added successfully!';
                } else {
                    $id = (int)$_POST['id'];
                    $stmt = $db->prepare("UPDATE slides SET title = ?, subtitle = ?, image_path = ?, button_text = ?, button_link = ?, sort_order = ?, active = ? WHERE id = ?");
                    $stmt->execute([$title, $subtitle, $image_path, $button_text, $button_link, $sort_order, $active, $id]);
                    $successMsg = 'Slide updated successfully!';
                }
            } elseif ($action === 'delete') {
                $id = (int)$_POST['id'];
                $stmt = $db->prepare("DELETE FROM slides WHERE id = ?");
                $stmt->execute([$id]);
                $successMsg = 'Slide deleted successfully!';
            }
            break;
            
        case 'categories':
            if ($action === 'add' || $action === 'edit') {
                $name = trim($_POST['name'] ?? '');
                $slug = trim($_POST['slug'] ?? '');
                $icon = trim($_POST['icon'] ?? '');
                $sort_order = (int)($_POST['sort_order'] ?? 0);
                
                if (empty($slug)) {
                    $slug = strtolower(str_replace(' ', '-', $name));
                }
                
                if ($action === 'add') {
                    $stmt = $db->prepare("INSERT INTO categories (name, slug, icon, sort_order) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$name, $slug, $icon, $sort_order]);
                    $successMsg = 'Category added successfully!';
                } else {
                    $id = (int)$_POST['id'];
                    $stmt = $db->prepare("UPDATE categories SET name = ?, slug = ?, icon = ?, sort_order = ? WHERE id = ?");
                    $stmt->execute([$name, $slug, $icon, $sort_order, $id]);
                    $successMsg = 'Category updated successfully!';
                }
            } elseif ($action === 'delete') {
                $id = (int)$_POST['id'];
                $stmt = $db->prepare("DELETE FROM categories WHERE id = ?");
                $stmt->execute([$id]);
                $successMsg = 'Category deleted successfully!';
            }
            break;
            
        case 'content':
            $aboutData = [
                'title' => trim($_POST['about_title'] ?? ''),
                'content' => trim($_POST['about_content'] ?? ''),
                'mission' => trim($_POST['about_mission'] ?? ''),
                'vision' => trim($_POST['about_vision'] ?? ''),
                'experience' => trim($_POST['about_experience'] ?? ''),
                'projects' => trim($_POST['about_projects'] ?? ''),
                'clients' => trim($_POST['about_clients'] ?? '')
            ];
            $contactData = [
                'phones' => array_filter(array_map('trim', explode(',', $_POST['contact_phones'] ?? ''))),
                'email' => trim($_POST['contact_email'] ?? ''),
                'address' => trim($_POST['contact_address'] ?? ''),
                'hours' => trim($_POST['contact_hours'] ?? ''),
                'instagram' => trim($_POST['contact_instagram'] ?? '')
            ];
            
            $stmt = $db->prepare("UPDATE content SET content_json = ? WHERE page = ?");
            $stmt->execute([json_encode($aboutData), 'about']);
            $stmt->execute([json_encode($contactData), 'contact']);
            $successMsg = 'Content updated successfully!';
            break;
            
        case 'inquiries':
            if ($action === 'delete') {
                $id = (int)$_POST['id'];
                $stmt = $db->prepare("DELETE FROM inquiries WHERE id = ?");
                $stmt->execute([$id]);
                $successMsg = 'Inquiry deleted successfully!';
            }
            break;
    }
}

if ($page !== 'login'):
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - AL TANWEER</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="images/logo-icon.png">
</head>
<body>
    <div class="admin-container">
        <div class="admin-header">
            <h1><i class="fas fa-cog"></i> Admin Panel</h1>
            <nav class="admin-nav">
                <a href="admin.php" class="<?php echo $page === 'dashboard' ? 'active' : ''; ?>"><i class="fas fa-home"></i> Dashboard</a>
                <a href="admin.php?page=slides" class="<?php echo $page === 'slides' ? 'active' : ''; ?>"><i class="fas fa-images"></i> Slides</a>
                <a href="admin.php?page=products" class="<?php echo $page === 'products' ? 'active' : ''; ?>"><i class="fas fa-box"></i> Products</a>
                <a href="admin.php?page=categories" class="<?php echo $page === 'categories' ? 'active' : ''; ?>"><i class="fas fa-tags"></i> Categories</a>
                <a href="admin.php?page=content" class="<?php echo $page === 'content' ? 'active' : ''; ?>"><i class="fas fa-file-alt"></i> Content</a>
                <a href="admin.php?page=inquiries" class="<?php echo $page === 'inquiries' ? 'active' : ''; ?>"><i class="fas fa-envelope"></i> Inquiries</a>
                <a href="index.php" target="_blank"><i class="fas fa-external-link-alt"></i> View Site</a>
                <a href="admin.php?page=logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </div>
        
        <?php if (isset($successMsg)): ?>
        <div class="form-message success" style="display: block; margin-bottom: 20px;">
            <i class="fas fa-check-circle"></i> <?php echo htmlspecialchars($successMsg); ?>
        </div>
        <?php endif; ?>

        <?php
        switch ($page):
            case 'dashboard':
                $productCount = $db->query("SELECT COUNT(*) FROM products")->fetchColumn();
                $inquiryCount = $db->query("SELECT COUNT(*) FROM inquiries")->fetchColumn();
                $slideCount = $db->query("SELECT COUNT(*) FROM slides")->fetchColumn();
                $categoryCount = $db->query("SELECT COUNT(*) FROM categories")->fetchColumn();
                $recentInquiries = $db->query("SELECT * FROM inquiries ORDER BY date_sent DESC LIMIT 5")->fetchAll();
        ?>
        <div class="stats-grid">
            <div class="stat-card">
                <i class="fas fa-images"></i>
                <h3><?php echo $slideCount; ?></h3>
                <p>Slides</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-box"></i>
                <h3><?php echo $productCount; ?></h3>
                <p>Products</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-tags"></i>
                <h3><?php echo $categoryCount; ?></h3>
                <p>Categories</p>
            </div>
            <div class="stat-card">
                <i class="fas fa-envelope"></i>
                <h3><?php echo $inquiryCount; ?></h3>
                <p>Inquiries</p>
            </div>
        </div>
        
        <div class="admin-card">
            <h2><i class="fas fa-clock"></i> Recent Inquiries</h2>
            <?php if (empty($recentInquiries)): ?>
            <p style="color: var(--text-muted);">No inquiries yet.</p>
            <?php else: ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recentInquiries as $inquiry): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($inquiry['name']); ?></td>
                        <td><a href="mailto:<?php echo htmlspecialchars($inquiry['email']); ?>" style="color: var(--gold);"><?php echo htmlspecialchars($inquiry['email']); ?></a></td>
                        <td><?php echo htmlspecialchars($inquiry['phone'] ?: '-'); ?></td>
                        <td><?php echo date('M d, Y', strtotime($inquiry['date_sent'])); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <a href="admin.php?page=inquiries" class="btn btn-outline" style="margin-top: 20px;">View All Inquiries</a>
            <?php endif; ?>
        </div>
        <?php
                break;
                
            case 'slides':
                $slides = $db->query("SELECT * FROM slides ORDER BY sort_order")->fetchAll();
                $editSlide = null;
                if ($action === 'edit' && isset($_GET['id'])) {
                    $stmt = $db->prepare("SELECT * FROM slides WHERE id = ?");
                    $stmt->execute([(int)$_GET['id']]);
                    $editSlide = $stmt->fetch();
                }
        ?>
        <div class="admin-card">
            <h2><i class="fas fa-images"></i> <?php echo $editSlide ? 'Edit Slide' : ($action === 'add' ? 'Add New Slide' : 'Manage Homepage Slides'); ?></h2>
            
            <?php if ($action === 'add' || $editSlide): ?>
            <form method="POST" enctype="multipart/form-data" style="max-width: 700px;">
                <?php if ($editSlide): ?>
                <input type="hidden" name="id" value="<?php echo $editSlide['id']; ?>">
                <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($editSlide['image_path']); ?>">
                <?php endif; ?>
                
                <div class="form-group">
                    <label>Slide Title</label>
                    <input type="text" name="title" value="<?php echo htmlspecialchars($editSlide['title'] ?? ''); ?>" placeholder="e.g., Premium Gates & Doors">
                </div>
                
                <div class="form-group">
                    <label>Subtitle</label>
                    <input type="text" name="subtitle" value="<?php echo htmlspecialchars($editSlide['subtitle'] ?? ''); ?>" placeholder="e.g., Crafted with Excellence">
                </div>
                
                <div class="form-group">
                    <label>Slide Image *</label>
                    <input type="file" name="image" accept="image/*" style="background: var(--primary-bg); padding: 15px;">
                    <?php if ($editSlide && $editSlide['image_path']): ?>
                    <p style="color: var(--text-muted); font-size: 12px; margin-top: 8px;">Current: <?php echo htmlspecialchars($editSlide['image_path']); ?></p>
                    <?php endif; ?>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Button Text</label>
                        <input type="text" name="button_text" value="<?php echo htmlspecialchars($editSlide['button_text'] ?? ''); ?>" placeholder="e.g., Explore Products">
                    </div>
                    
                    <div class="form-group">
                        <label>Button Link</label>
                        <input type="text" name="button_link" value="<?php echo htmlspecialchars($editSlide['button_link'] ?? ''); ?>" placeholder="e.g., products.php">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Sort Order</label>
                        <input type="number" name="sort_order" value="<?php echo htmlspecialchars($editSlide['sort_order'] ?? 0); ?>" min="0">
                    </div>
                    
                    <div class="form-group">
                        <label style="display: flex; align-items: center; gap: 10px; margin-top: 30px;">
                            <input type="checkbox" name="active" <?php echo ($editSlide['active'] ?? 1) ? 'checked' : ''; ?>>
                            Active (Show on homepage)
                        </label>
                    </div>
                </div>
                
                <div style="display: flex; gap: 15px; margin-top: 30px;">
                    <button type="submit" class="btn btn-primary"><?php echo $editSlide ? 'Update Slide' : 'Add Slide'; ?></button>
                    <a href="admin.php?page=slides" class="btn btn-outline">Cancel</a>
                </div>
            </form>
            
            <?php else: ?>
            <div style="margin-bottom: 25px;">
                <a href="admin.php?page=slides&action=add" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Slide</a>
            </div>
            
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Title</th>
                        <th>Subtitle</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($slides as $slide): ?>
                    <tr>
                        <td><?php echo $slide['sort_order']; ?></td>
                        <td><?php echo htmlspecialchars($slide['title'] ?: '(No title)'); ?></td>
                        <td><?php echo htmlspecialchars($slide['subtitle'] ?: '-'); ?></td>
                        <td><?php echo $slide['active'] ? '<span style="color: #4CAF50;"><i class="fas fa-check-circle"></i> Active</span>' : '<span style="color: #999;">Inactive</span>'; ?></td>
                        <td>
                            <div class="admin-actions">
                                <a href="admin.php?page=slides&action=edit&id=<?php echo $slide['id']; ?>" class="admin-btn edit">Edit</a>
                                <form method="POST" action="admin.php?page=slides&action=delete" style="display: inline;" onsubmit="return confirm('Delete this slide?');">
                                    <input type="hidden" name="id" value="<?php echo $slide['id']; ?>">
                                    <button type="submit" class="admin-btn delete">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
        <?php
                break;
                
            case 'products':
                $products = $db->query("SELECT * FROM products ORDER BY category, name")->fetchAll();
                $categories = $db->query("SELECT * FROM categories ORDER BY sort_order")->fetchAll();
                $editProduct = null;
                if ($action === 'edit' && isset($_GET['id'])) {
                    $stmt = $db->prepare("SELECT * FROM products WHERE id = ?");
                    $stmt->execute([(int)$_GET['id']]);
                    $editProduct = $stmt->fetch();
                }
        ?>
        <div class="admin-card">
            <h2><i class="fas fa-box"></i> <?php echo $editProduct ? 'Edit Product' : ($action === 'add' ? 'Add New Product' : 'Manage Products'); ?></h2>
            
            <?php if ($action === 'add' || $editProduct): 
                $specs = $editProduct ? json_decode($editProduct['specifications_json'], true) ?? [] : [];
            ?>
            <form method="POST" enctype="multipart/form-data" style="max-width: 700px;">
                <?php if ($editProduct): ?>
                <input type="hidden" name="id" value="<?php echo $editProduct['id']; ?>">
                <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($editProduct['image_path']); ?>">
                <?php endif; ?>
                
                <div class="form-group">
                    <label>Product Name *</label>
                    <input type="text" name="name" required value="<?php echo htmlspecialchars($editProduct['name'] ?? ''); ?>" placeholder="e.g., Premium Iron Gate TW-001">
                </div>
                
                <div class="form-group">
                    <label>Category *</label>
                    <select name="category" required style="width: 100%; padding: 18px 20px; background: var(--primary-bg); border: 1px solid var(--border-gold); color: var(--text-light); font-size: 15px;">
                        <option value="">-- Select Category --</option>
                        <?php foreach ($categories as $cat): ?>
                        <option value="<?php echo htmlspecialchars($cat['slug']); ?>" <?php echo ($editProduct['category'] ?? '') === $cat['slug'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($cat['name']); ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" rows="4" placeholder="Describe the product..."><?php echo htmlspecialchars($editProduct['description'] ?? ''); ?></textarea>
                </div>
                
                <div class="form-group">
                    <label>Product Image</label>
                    <input type="file" name="image" accept="image/*" style="background: var(--primary-bg); padding: 15px;">
                    <?php if ($editProduct && $editProduct['image_path']): ?>
                    <p style="color: var(--text-muted); font-size: 12px; margin-top: 8px;">Current: <?php echo htmlspecialchars($editProduct['image_path']); ?></p>
                    <?php endif; ?>
                </div>
                
                <div class="form-group">
                    <label style="display: flex; align-items: center; gap: 10px;">
                        <input type="checkbox" name="featured" <?php echo ($editProduct['featured'] ?? 0) ? 'checked' : ''; ?>>
                        Featured Product (show on homepage)
                    </label>
                </div>
                
                <div class="form-group">
                    <label>Specifications</label>
                    <div id="specs-container">
                        <?php if (!empty($specs)): ?>
                            <?php foreach ($specs as $key => $value): ?>
                            <div style="display: flex; gap: 10px; margin-bottom: 10px;">
                                <input type="text" name="spec_keys[]" placeholder="Key (e.g., Material)" value="<?php echo htmlspecialchars($key); ?>" style="flex: 1;">
                                <input type="text" name="spec_values[]" placeholder="Value" value="<?php echo htmlspecialchars($value); ?>" style="flex: 1;">
                                <button type="button" onclick="this.parentElement.remove()" style="background: #dc3545; color: white; border: none; padding: 0 15px; cursor: pointer;">&times;</button>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div style="display: flex; gap: 10px; margin-bottom: 10px;">
                                <input type="text" name="spec_keys[]" placeholder="Key (e.g., Material)" style="flex: 1;">
                                <input type="text" name="spec_values[]" placeholder="Value" style="flex: 1;">
                                <button type="button" onclick="this.parentElement.remove()" style="background: #dc3545; color: white; border: none; padding: 0 15px; cursor: pointer;">&times;</button>
                            </div>
                        <?php endif; ?>
                    </div>
                    <button type="button" class="btn btn-outline" style="padding: 10px 20px; font-size: 12px;" onclick="addSpecField()"><i class="fas fa-plus"></i> Add Specification</button>
                </div>
                
                <div style="display: flex; gap: 15px; margin-top: 30px;">
                    <button type="submit" class="btn btn-primary"><?php echo $editProduct ? 'Update Product' : 'Add Product'; ?></button>
                    <a href="admin.php?page=products" class="btn btn-outline">Cancel</a>
                </div>
            </form>
            
            <script>
            function addSpecField() {
                const container = document.getElementById('specs-container');
                const div = document.createElement('div');
                div.style.cssText = 'display: flex; gap: 10px; margin-bottom: 10px;';
                div.innerHTML = '<input type="text" name="spec_keys[]" placeholder="Key (e.g., Material)" style="flex: 1;"><input type="text" name="spec_values[]" placeholder="Value" style="flex: 1;"><button type="button" onclick="this.parentElement.remove()" style="background: #dc3545; color: white; border: none; padding: 0 15px; cursor: pointer;">&times;</button>';
                container.appendChild(div);
            }
            </script>
            
            <?php else: ?>
            <div style="margin-bottom: 25px;">
                <a href="admin.php?page=products&action=add" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Product</a>
            </div>
            
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Featured</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td><?php echo htmlspecialchars(ucfirst(str_replace('-', ' ', $product['category']))); ?></td>
                        <td><?php echo $product['featured'] ? '<i class="fas fa-star" style="color: var(--gold);"></i>' : '-'; ?></td>
                        <td>
                            <div class="admin-actions">
                                <a href="admin.php?page=products&action=edit&id=<?php echo $product['id']; ?>" class="admin-btn edit">Edit</a>
                                <form method="POST" action="admin.php?page=products&action=delete" style="display: inline;" onsubmit="return confirm('Delete this product?');">
                                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                    <button type="submit" class="admin-btn delete">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
        <?php
                break;
                
            case 'categories':
                $categories = $db->query("SELECT * FROM categories ORDER BY sort_order")->fetchAll();
                $editCategory = null;
                if ($action === 'edit' && isset($_GET['id'])) {
                    $stmt = $db->prepare("SELECT * FROM categories WHERE id = ?");
                    $stmt->execute([(int)$_GET['id']]);
                    $editCategory = $stmt->fetch();
                }
        ?>
        <div class="admin-card">
            <h2><i class="fas fa-tags"></i> <?php echo $editCategory ? 'Edit Category' : ($action === 'add' ? 'Add New Category' : 'Manage Categories'); ?></h2>
            
            <?php if ($action === 'add' || $editCategory): ?>
            <form method="POST" style="max-width: 600px;">
                <?php if ($editCategory): ?>
                <input type="hidden" name="id" value="<?php echo $editCategory['id']; ?>">
                <?php endif; ?>
                
                <div class="form-group">
                    <label>Category Name *</label>
                    <input type="text" name="name" required value="<?php echo htmlspecialchars($editCategory['name'] ?? ''); ?>" placeholder="e.g., Gates">
                </div>
                
                <div class="form-group">
                    <label>Slug (URL-friendly name)</label>
                    <input type="text" name="slug" value="<?php echo htmlspecialchars($editCategory['slug'] ?? ''); ?>" placeholder="e.g., gates (auto-generated if empty)">
                </div>
                
                <div class="form-group">
                    <label>Icon (Font Awesome class)</label>
                    <input type="text" name="icon" value="<?php echo htmlspecialchars($editCategory['icon'] ?? ''); ?>" placeholder="e.g., fa-door-closed">
                    <p style="color: var(--text-muted); font-size: 12px; margin-top: 8px;">Browse icons at: <a href="https://fontawesome.com/icons" target="_blank" style="color: var(--gold);">fontawesome.com/icons</a></p>
                </div>
                
                <div class="form-group">
                    <label>Sort Order</label>
                    <input type="number" name="sort_order" value="<?php echo htmlspecialchars($editCategory['sort_order'] ?? 0); ?>" min="0">
                </div>
                
                <div style="display: flex; gap: 15px; margin-top: 30px;">
                    <button type="submit" class="btn btn-primary"><?php echo $editCategory ? 'Update Category' : 'Add Category'; ?></button>
                    <a href="admin.php?page=categories" class="btn btn-outline">Cancel</a>
                </div>
            </form>
            
            <?php else: ?>
            <div style="margin-bottom: 25px;">
                <a href="admin.php?page=categories&action=add" class="btn btn-primary"><i class="fas fa-plus"></i> Add New Category</a>
            </div>
            
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Icon</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $cat): ?>
                    <tr>
                        <td><?php echo $cat['sort_order']; ?></td>
                        <td><i class="fas <?php echo htmlspecialchars($cat['icon'] ?: 'fa-folder'); ?>" style="color: var(--gold); font-size: 20px;"></i></td>
                        <td><?php echo htmlspecialchars($cat['name']); ?></td>
                        <td><code style="background: var(--primary-bg); padding: 3px 8px;"><?php echo htmlspecialchars($cat['slug']); ?></code></td>
                        <td>
                            <div class="admin-actions">
                                <a href="admin.php?page=categories&action=edit&id=<?php echo $cat['id']; ?>" class="admin-btn edit">Edit</a>
                                <form method="POST" action="admin.php?page=categories&action=delete" style="display: inline;" onsubmit="return confirm('Delete this category?');">
                                    <input type="hidden" name="id" value="<?php echo $cat['id']; ?>">
                                    <button type="submit" class="admin-btn delete">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
        <?php
                break;
                
            case 'content':
                $aboutStmt = $db->query("SELECT content_json FROM content WHERE page = 'about'");
                $aboutRow = $aboutStmt->fetch();
                $about = $aboutRow ? json_decode($aboutRow['content_json'], true) : [];
                
                $contactStmt = $db->query("SELECT content_json FROM content WHERE page = 'contact'");
                $contactRow = $contactStmt->fetch();
                $contact = $contactRow ? json_decode($contactRow['content_json'], true) : [];
        ?>
        <div class="admin-card">
            <h2><i class="fas fa-file-alt"></i> Manage Website Content</h2>
            <form method="POST" style="max-width: 800px;">
                <h3 style="color: var(--gold); margin: 30px 0 25px; padding-bottom: 15px; border-bottom: 1px solid var(--border-gold);"><i class="fas fa-info-circle"></i> About Us Page</h3>
                
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="about_title" value="<?php echo htmlspecialchars($about['title'] ?? ''); ?>" placeholder="e.g., About AL TANWEER">
                </div>
                
                <div class="form-group">
                    <label>Main Content</label>
                    <textarea name="about_content" rows="4" placeholder="Company description..."><?php echo htmlspecialchars($about['content'] ?? ''); ?></textarea>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Mission Statement</label>
                        <textarea name="about_mission" rows="2"><?php echo htmlspecialchars($about['mission'] ?? ''); ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Vision Statement</label>
                        <textarea name="about_vision" rows="2"><?php echo htmlspecialchars($about['vision'] ?? ''); ?></textarea>
                    </div>
                </div>
                
                <div class="form-row" style="grid-template-columns: repeat(3, 1fr);">
                    <div class="form-group">
                        <label>Years Experience</label>
                        <input type="text" name="about_experience" value="<?php echo htmlspecialchars($about['experience'] ?? ''); ?>" placeholder="e.g., 20+">
                    </div>
                    <div class="form-group">
                        <label>Projects Completed</label>
                        <input type="text" name="about_projects" value="<?php echo htmlspecialchars($about['projects'] ?? ''); ?>" placeholder="e.g., 5000+">
                    </div>
                    <div class="form-group">
                        <label>Happy Clients</label>
                        <input type="text" name="about_clients" value="<?php echo htmlspecialchars($about['clients'] ?? ''); ?>" placeholder="e.g., 3000+">
                    </div>
                </div>
                
                <h3 style="color: var(--gold); margin: 50px 0 25px; padding-bottom: 15px; border-bottom: 1px solid var(--border-gold);"><i class="fas fa-phone-alt"></i> Contact Information</h3>
                
                <div class="form-group">
                    <label>Phone Numbers (comma-separated)</label>
                    <input type="text" name="contact_phones" value="<?php echo htmlspecialchars(implode(', ', $contact['phones'] ?? [])); ?>" placeholder="e.g., 050 549 7469, 050 201 1482">
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="contact_email" value="<?php echo htmlspecialchars($contact['email'] ?? ''); ?>" placeholder="e.g., tanweerdoor@gmail.com">
                    </div>
                    
                    <div class="form-group">
                        <label>Instagram Handle</label>
                        <input type="text" name="contact_instagram" value="<?php echo htmlspecialchars($contact['instagram'] ?? ''); ?>" placeholder="e.g., tanweerdoors">
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="contact_address" value="<?php echo htmlspecialchars($contact['address'] ?? ''); ?>" placeholder="e.g., Ind Aera Sajaa Sharjah">
                </div>
                
                <div class="form-group">
                    <label>Working Hours</label>
                    <input type="text" name="contact_hours" value="<?php echo htmlspecialchars($contact['hours'] ?? ''); ?>" placeholder="e.g., Saturday - Thursday: 8:00 AM - 6:00 PM">
                </div>
                
                <button type="submit" class="btn btn-primary" style="margin-top: 30px;"><i class="fas fa-save"></i> Save All Changes</button>
            </form>
        </div>
        <?php
                break;
                
            case 'inquiries':
                $inquiries = $db->query("SELECT * FROM inquiries ORDER BY date_sent DESC")->fetchAll();
        ?>
        <div class="admin-card">
            <h2><i class="fas fa-envelope"></i> Customer Inquiries</h2>
            
            <?php if (empty($inquiries)): ?>
            <p style="color: var(--text-muted); text-align: center; padding: 40px;">No inquiries received yet.</p>
            <?php else: ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($inquiries as $inquiry): ?>
                    <tr>
                        <td style="white-space: nowrap;"><?php echo date('M d, Y<\b\r>H:i', strtotime($inquiry['date_sent'])); ?></td>
                        <td><?php echo htmlspecialchars($inquiry['name']); ?></td>
                        <td><a href="mailto:<?php echo htmlspecialchars($inquiry['email']); ?>" style="color: var(--gold);"><?php echo htmlspecialchars($inquiry['email']); ?></a></td>
                        <td><?php echo htmlspecialchars($inquiry['phone'] ?: '-'); ?></td>
                        <td style="max-width: 300px;">
                            <div style="max-height: 60px; overflow: hidden; font-size: 13px; color: var(--text-muted);" title="<?php echo htmlspecialchars($inquiry['message']); ?>">
                                <?php echo htmlspecialchars($inquiry['message']); ?>
                            </div>
                        </td>
                        <td>
                            <form method="POST" action="admin.php?page=inquiries&action=delete" style="display: inline;" onsubmit="return confirm('Delete this inquiry?');">
                                <input type="hidden" name="id" value="<?php echo $inquiry['id']; ?>">
                                <button type="submit" class="admin-btn delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?php endif; ?>
        </div>
        <?php
                break;
        endswitch;
        ?>
    </div>
</body>
</html>
<?php else: ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - AL TANWEER</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/png" href="images/logo-icon.png">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <img src="images/logo-icon.png" alt="AL TANWEER">
            <h1>Admin Login</h1>
            <p>AL TANWEER DOORS & WINDOWS TR.</p>
            
            <?php if (isset($loginError)): ?>
            <div class="login-error"><i class="fas fa-exclamation-circle"></i> <?php echo htmlspecialchars($loginError); ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required placeholder="Enter username" autocomplete="username">
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required placeholder="Enter password" autocomplete="current-password">
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
            
            <p style="margin-top: 30px; font-size: 12px; color: var(--text-muted);">
                <!-- Default: admin / admin123 -->
            </p>
            
            <a href="index.php" style="display: block; margin-top: 25px; color: var(--gold); font-size: 14px;">
                <i class="fas fa-arrow-left"></i> Back to Website
            </a>
        </div>
    </div>
</body>
</html>
<?php endif; ?>
