function toggleReplyForm(commentId) {
    var form = document.getElementById('reply-form-' + commentId);
    console.log(form)
    console.log('Attempting to toggle reply form with ID:', 'reply-form-' + commentId);
    console.log('Form Element:', form);

    if (form) {
        if (form.style.display === 'none' || form.style.display === '') {
            console.log('Displaying the form');
            form.style.display = 'block';
        } else {
            console.log('Hiding the form');
            form.style.display = 'none';
        }
    } else {
        console.error('Form not found with ID:', 'reply-form-' + commentId);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.show-all-replies-btn').forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            let commentId = this.getAttribute('data-comment-id');
            let repliesContainer = document.getElementById('replies-container-' + commentId);
            console.log('Attempting to show all replies for comment ID:', commentId);
            console.log('Replies Container:', repliesContainer);

            if (repliesContainer) {
                repliesContainer.style.display = 'block';
                this.style.display = 'none'; // Hide the "show all replies" button after showing all replies
            } else {
                console.error('Replies container not found with ID:', 'replies-container-' + commentId);
            }
        });
    });
});

function toggleEditForm(commentId, content) {
    const editForm = document.getElementById(`edit-form-${commentId}`);
    console.log('Attempting to toggle edit form with ID:', `edit-form-${commentId}`);
    console.log('Edit Form Element:', editForm);

    if (editForm) {
        editForm.style.display = editForm.style.display === 'none' ? 'block' : 'none';
        const textarea = editForm.querySelector('textarea');
        if (textarea) {
            textarea.focus();
        } else {
            console.error('Textarea not found inside edit form with ID:', `edit-form-${commentId}`);
        }
    } else {
        console.error('Edit form not found with ID:', `edit-form-${commentId}`);
    }
}

document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.edit-form form').forEach(form => {
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            const commentId = form.id.split('-').pop();
            const url = form.action;
            const formData = new FormData(form);

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        const commentElement = document.querySelector(`#comment-${commentId} .comment-content`);
                        if (commentElement) {
                            commentElement.innerText = data.content;
                            document.getElementById(`edit-form-${commentId}`).style.display = 'none';
                        } else {
                            console.error('Comment element not found with ID:', `comment-${commentId}`);
                        }
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    error.text().then(errorMessage => {
                        console.error('Error message:', errorMessage);
                    });
                });
        });
    });
});

document.querySelectorAll('.reply-btn').forEach(function (button) {
    button.addEventListener('click', function (event) {
        event.preventDefault();
        let commentId = this.getAttribute('data-comment-id');
        let form = document.getElementById('reply-form-' + commentId);
        if (form) {
            form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
        }
    });
});

