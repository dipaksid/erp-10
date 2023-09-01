let deleteId = null;
function showConfirmDeleteModal(event, id) {
    event.preventDefault(); // Prevent the default form submission

    deleteId = id;
    const modal = new bootstrap.Modal(document.getElementById('confirmDeleteModal'));
    modal._element.addEventListener('hidden.bs.modal', function () {
        deleteId = null;
    });
    modal.show();
}
function deleteUser() {
    if (deleteId !== null) {
        const formId = `deleteForm_${deleteId}`;
        document.getElementById(formId).submit();
    }
}
// function removeModalBackdrop() {
//     //$('.modal-backdrop').remove();
//     var modalBackdrop = document.querySelector('.modal-backdrop');
//     if (modalBackdrop) {
//         modalBackdrop.parentNode.removeChild(modalBackdrop);
//     }
//
//     var modalElement = document.getElementById('confirmDeleteModal');
//     if (modalElement) {
//         var bsModal = new bootstrap.Modal(modalElement);
//         bsModal.hide(); // Hide the modal using Bootstrap's method
//     }
// }
function removeModalBackdrop() {
    console.log("ae dofa");
    var modalBackdrop = document.querySelector('.modal-backdrop');
    if (modalBackdrop) {
        modalBackdrop.parentNode.removeChild(modalBackdrop);
    }

    var modalElement = document.getElementById('confirmDeleteModal');
    if (modalElement) {
        modalElement.style.display = 'none'; // Hide the modal by changing its display style
        modalElement.classList.remove('show'); // Remove the 'show' class
        document.body.classList.remove('modal-open'); // Remove 'modal-open' class from body
    }
}

function hideSuccessMessage() {
    document.getElementById('success-message').style.display = 'none';
}
