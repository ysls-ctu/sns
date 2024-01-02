document.addEventListener('DOMContentLoaded', function () {
    const tagInput = document.getElementById('tagInput');
    const tagListContainer = document.getElementById('tagList');

    tagInput.addEventListener('keydown', function (event) {
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
        closeButton.textContent = 'X';
        closeButton.addEventListener('click', function () {
            tagListContainer.removeChild(tag);
        });

        tag.appendChild(closeButton);
        tagListContainer.appendChild(tag);
    }
});
