<?php
require_once("../settings/core.php");
if (!is_logged_in() || !is_admin()) {
    header("Location: ../login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Category Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">
    <h2 class="mb-4 text-center">Manage Categories</h2>
    <div class="card mb-4">
        <div class="card-header">Add Category</div>
        <div class="card-body">
            <form id="addCategoryForm" class="row g-3">
                <div class="col-md-8">
                    <input type="text" class="form-control" id="categoryName" placeholder="Category Name" required>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary w-100">Add Category</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">Your Categories</div>
        <div class="card-body">
            <ul class="list-group" id="categoryList"></ul>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form class="modal-content" id="editCategoryForm">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="editCategoryId">
        <input type="text" class="form-control" id="editCategoryName" required>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Save Changes</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/category.js"></script>
<script>
// Fetch and render categories
function renderCategories() {
    fetch('../actions/fetch_category_action.php')
        .then(res => res.json())
        .then(data => {
            const list = document.getElementById('categoryList');
            list.innerHTML = '';
            data.forEach(cat => {
                const li = document.createElement('li');
                li.className = 'list-group-item d-flex justify-content-between align-items-center';
                li.innerHTML = `
                    <span>${cat.name}</span>
                    <div>
                        <button class="btn btn-sm btn-warning me-2" onclick="showEditModal(${cat.id}, '${cat.name}')">Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="deleteCategory(${cat.id})">Delete</button>
                    </div>
                `;
                list.appendChild(li);
            });
        });
}
renderCategories();

// Add category
document.getElementById('addCategoryForm').onsubmit = function(e) {
    e.preventDefault();
    const name = document.getElementById('categoryName').value;
    fetch('../actions/add_category_action.php', {
        method: 'POST',
        body: new URLSearchParams({ name })
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        if (data.success) {
            document.getElementById('categoryName').value = '';
            renderCategories();
        }
    });
};

// Show edit modal
function showEditModal(id, name) {
    document.getElementById('editCategoryId').value = id;
    document.getElementById('editCategoryName').value = name;
    new bootstrap.Modal(document.getElementById('editModal')).show();
}

// Edit category
document.getElementById('editCategoryForm').onsubmit = function(e) {
    e.preventDefault();
    const id = document.getElementById('editCategoryId').value;
    const name = document.getElementById('editCategoryName').value;
    fetch('../actions/update_category_action.php', {
        method: 'POST',
        body: new URLSearchParams({ id, name })
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        if (data.success) {
            bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
            renderCategories();
        }
    });
};

// Delete category
function deleteCategory(id) {
    if (!confirm("Delete this category?")) return;
    fetch('../actions/delete_category_action.php', {
        method: 'POST',
        body: new URLSearchParams({ id })
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
        if (data.success) renderCategories();
    });
}
</script>
</body>
</html>