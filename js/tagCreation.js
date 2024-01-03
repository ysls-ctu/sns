// tag addition
document.addEventListener('DOMContentLoaded', function () {
    const tagInput = document.getElementById('tagInput');
    let tagListContainer = document.getElementById('tagList');

    // Check if tagListContainer is null and create the element if needed
    if (!tagListContainer) {
        tagListContainer = document.createElement('div');
        tagListContainer.id = 'tagList';
        document.body.appendChild(tagListContainer);
    }

    tagInput.addEventListener('keyup', function (event) {
        if (event.key === 'Enter' && tagInput.value.trim() !== '') {
            addTag(tagInput.value.trim());
            tagInput.value = '';
        }
    });

    function addTag(tagText) {
        const tag = document.createElement('div');
        tag.classList.add('tag');
        tag.textContent = tagText;

        const closeButton = document.createElement('span');
        closeButton.innerHTML = '<i class="fa-solid fa-xmark"></i>';
        closeButton.addEventListener('click', function () {
            tagListContainer.removeChild(tag);
        });

        tag.appendChild(closeButton);

        tagListContainer.appendChild(tag);
    }
});