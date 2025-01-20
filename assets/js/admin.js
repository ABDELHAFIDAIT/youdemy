let list = document.querySelector('#links');
const menu = document.querySelector('#burger-menu');

menu.addEventListener('click',function(){
    list.classList.toggle('left-0');
    list.classList.toggle('left-[-500px]');
});



const cancelButtonTag = document.querySelector('#cancel-tag');
const TagFormContainer = document.querySelector('#add-tag-form');
const openTagForm = document.querySelector('#open-add-tag');
const TagForm = document.querySelector('#addTagForm');

cancelButtonTag.addEventListener('click', function() {
    TagFormContainer.style.display = 'none';
    TagForm.reset();
});

openTagForm.addEventListener('click', function() {
    TagFormContainer.style.display = 'flex';
});


const openMultipleTagsBtn = document.querySelector('button.bg-gradient-to-r.from-purple-500');
const addMultipleTagsForm = document.getElementById('add-multiple-tags-form');
const cancelMultipleTagsBtn = document.getElementById('cancel-multiple-tags');

openMultipleTagsBtn.addEventListener('click', () => {
    addMultipleTagsForm.style.display = 'flex';
});

cancelMultipleTagsBtn.addEventListener('click', () => {
    addMultipleTagsForm.style.display = 'none';
});


const editModal = document.getElementById('edit-tag-modal');
const editForm = document.getElementById('editTagForm');
const editTagId = document.getElementById('edit-tag-id');
const editTagName = document.getElementById('edit-tag-name');

function openEditModal(tagId, tagName) {
    editTagId.value = tagId;
    editTagName.value = tagName;
    editModal.style.display = 'flex';
}

function closeEditModal() {
    editModal.style.display = 'none';
}

editForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData();
    formData.append('id_tag', editTagId.value);
    formData.append('new_name', editTagName.value);

    fetch('../../actions/update_tag.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            const tagCard = document.querySelector(`[data-tag-id="${editTagId.value}"]`);
            const tagName = tagCard.querySelector('h3');
            tagName.textContent = editTagName.value;
            closeEditModal();
        } else {
            alert('Erreur lors de la modification du tag: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Une erreur est survenue lors de la modification du tag');
    });
});



const cancelButtonCategory = document.querySelector('#cancel-cat');
const CategoryFormContainer = document.querySelector('#add-cat-form');
const openCategoryForm = document.querySelector('#open-add-cat');
const CategoryForm = document.querySelector('#addCategoryForm');

cancelButtonCategory.addEventListener('click', function() {
    CategoryFormContainer.style.display = 'none';
    CategoryForm.reset();
});

openCategoryForm.addEventListener('click', function() {
    CategoryFormContainer.style.display = 'flex';
});