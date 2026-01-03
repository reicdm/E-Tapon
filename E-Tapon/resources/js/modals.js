window.openAcceptRequest = function () {
    document.getElementById('requestModal').style.display = 'none';
    document.getElementById('confirmModal').style.display = 'flex';
};

window.closeRequestModal = function () {
    document.getElementById('requestModal').style.display = 'none';
};

window.confirmRequest = function () {
    document.getElementById('confirmModal').style.display = 'none';
    document.getElementById('successModal').style.display = 'flex';
};

window.closeConfirmModal = function () {
    document.getElementById('confirmModal').style.display = 'none';
};

window.closeSuccessModal = function () {
    document.getElementById('successModal').style.display = 'none';
};
