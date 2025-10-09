function fetchCategories() {
    fetch('actions/fetch_category_action.php')
        .then(res => res.json())
        .then(data => {
            // Render categories in your HTML
        });
}
function addCategory(name) {
    if (!name.trim()) {
        alert("Category name required");
        return;
    }
    fetch('actions/add_category_action.php', {
        method: 'POST',
        body: new URLSearchParams({ name })
    })
    .then(res => res.json())
    .then(data => alert(data.message));
}
function updateCategory(id, name) {
    if (!name.trim()) {
        alert("Category name required");
        return;
    }
    fetch('actions/update_category_action.php', {
        method: 'POST',
        body: new URLSearchParams({ id, name })
    })
    .then(res => res.json())
    .then(data => alert(data.message));
}
function deleteCategory(id) {
    if (!confirm("Delete this category?")) return;
    fetch('actions/delete_category_action.php', {
        method: 'POST',
        body: new URLSearchParams({ id })
    })
    .then(res => res.json())
    .then(data => alert(data.message));
}