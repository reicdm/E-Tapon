<!-- ACCEPTED REQUEST DETAILS MODAL -->
<div id="acceptedModal" class="modal-overlay" style="display: none;">
    <div class="modal-popup">
        <button class="modal-close-btn" onclick="closeAcceptedModal()">&times;</button>

        <div class="row justify-content-center mb-4 mt-2">
            <div class="modal-circle"></div>
            <h2 class="font-extrabold" style="color: var(--color-dark-green)">Request Details</h2>
        </div>

        <div class="card-field-nr">
            <label>Name</label>
            <input id="accname" type="text" class="form-control" value="" readonly>
        </div>

        <div class="card-field-nr mb-2">
            <label>Resident</label>
            <input id="accbrgy" type="text" class="form-control" value="" readonly>
        </div>

        <div class="form-row-container">
            <div class="card-field-wq mb-2">
                <label class="form-label">Waste Type</label>
                <input id="accwaste" type="text" class="form-control" value="" readonly>
            </div>

            <div class="card-field-wq mb-2">
                <label class="form-label">Quantity</label>
                <input id="accquantity" type="text" class="form-control" value="" readonly>
            </div>
        </div>

        <div class="card-field-dt">
            <label>Preferred Date</label>
            <input id="accdate" type="text" class="form-control" value="" readonly>
        </div>

        <div class="card-field-dt">
            <label>Preferred Time</label>
            <input id="acctime" type="text" class="form-control" value="" readonly>
        </div>

        <div class="card-field-t">
            <label>Assigned Truck</label>
            <input id="acctruck" type="text" class="form-control" value="" readonly>
        </div>

        <hr class="my-3">
        <div class="update-status-card">
            <h4 class="update-title">Update Status</h4>
            <!-- STATUS OPTIONS -->
            <div class="status-options mb-4">
                <button type="button" class="sched-status-assigned" data-status="Assigned">
                    Assigned
                </button>

                <button type="button" class="sched-status-cancelled" data-status="Cancelled">
                    Cancelled
                </button>

                <button type="button" class="sched-status-inprogress" data-status="In Progress">
                    In Progress
                </button>

                <button type="button" class="sched-status-completed" data-status="Completed">
                    Completed
                </button>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="status-actions">
                <button class="btn-update push" onclick="openUpdateRequest()">Update</button>
                <button class="btn-cancel push" onclick="closeAcceptedModal()">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- UPDATE CONFIRMATION MODAL -->
<div id="updateModal" class="confirm-overlay" style="display: none;">
    <div class="popup-confirm">
        <div class="circle-pop"></div>
        <h2 class="my-2">Are you sure you want to update the status?</h2>

        <div class="action-buttons mt-4">
            <button class="btn-confirm" onclick="confirmUpdateRequest()">Confirm</button>
            <button class="btn-cancel" onclick="closeUpdateConfirmModal()">Cancel</button>
        </div>
    </div>
</div>

<!-- UPDATE SUCCESS MODAL -->
<div id="updateSuccessModal" class="success-overlay" style="display: none;">
    <div class="popup-success">
        <div class="popup-box"></div>
        <h2 class="text-4xl font-extrabold my-2">Status Updated!</h2>

        <div class="action-buttons mt-3">
            <button class="btn-ok" onclick="closeUpdateSuccessModal()">Confirm</button>
        </div>
    </div>
</div>

<style>
    .update-status-card {
        text-align: flex-start;
    }

    .update-title {
        font-size: 16px;
        font-weight: bold;
        color: var(--color-dark-green);
        margin-bottom: 12px;
    }

    .status-options {
        display: flex;
        gap: 10px;
        justify-content: center;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .sched-status-completed,
    .sched-status-inprogress,
    .sched-status-assigned,
    .sched-status-cancelled {
        width: 150px;
        font-size: 12px;
        border-radius: 10px;
        font-weight: 400;
        padding: 0.15rem;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.25);
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .sched-status-completed {
        background-color: var(--color-completed);
        color: white;
    }

    .sched-status-completed.active {
        border: 2px solid;
        color: black;
        background-color: var(--color-bg-completed);
        border-color: var(--color-completed);
    }

    .sched-status-inprogress {
        background-color: var(--color-inprogress);
        color: white;
    }

    .sched-status-inprogress.active {
        border: 2px solid;
        color: black;
        background-color: var(--color-bg-inprogress);
        border-color: var(--color-inprogress);
    }

    .sched-status-assigned {
        background-color: var(--color-assigned);
        color: white;
    }

    .sched-status-assigned.active {
        border: 2px solid;
        color: black;
        background-color: var(--color-bg-assigned);
        border-color: var(--color-assigned);
    }

    .sched-status-cancelled {
        background-color: var(--color-cancelled);
        color: white;
    }

    .sched-status-cancelled.active {
        border: 2px solid;
        color: black;
        background-color: var(--color-bg-cancelled);
        border-color: var(--color-cancelled);
    }

    .btn-update {
        background-image: linear-gradient(to top, #ff9100, #FFA733);
        color: white;
        border: none;
    }

    .btn-cancel-update {
        background: var(--color-cream);
        color: var(--color-orange);
        border: 2px solid var(--color-orange);
    }

    .btn-update,
    .btn-cancel-update {
        width: 100px;
        padding: 10px 24px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;
        position: relative;
        top: 0;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.25);
        transition: all 0.2s ease;
    }

    .btn-update:active,
    .btn-cancel-update:active {
        top: 3px;
        box-shadow: 0 2px 0px var(--color-orange);
    }
</style>

<script>
    // Open accepted request modal and populate with data
    function openAcceptedModal(button) {
        console.log('Opening accepted modal...');

        document.getElementById('accname').value = button.dataset.accname || '';
        document.getElementById('accbrgy').value = button.dataset.accbrgy || '';
        document.getElementById('accwaste').value = button.dataset.accwaste || '';
        document.getElementById('accquantity').value = button.dataset.accquantity || '';
        document.getElementById('accdate').value = button.dataset.accdate || '';
        document.getElementById('acctime').value = button.dataset.acctime || '';
        document.getElementById('acctruck').value = button.dataset.acctruck || '';

        // Store request ID and current status for later use
        const modal = document.getElementById('acceptedModal');
        modal.dataset.requestId = button.dataset.requestId || '';
        modal.dataset.currentStatus = button.dataset.currentStatus || '';

        // Set the current status as active
        const currentStatus = button.dataset.currentStatus || '';
        document.querySelectorAll('#acceptedModal .status-options button').forEach(btn => {
            btn.classList.remove('active');
            if (btn.dataset.status === currentStatus) {
                btn.classList.add('active');
            }
        });

        modal.style.display = 'flex';
    }

    function closeAcceptedModal() {
        document.getElementById('acceptedModal').style.display = 'none';
    }

    // Status button selection in accepted modal
    document.addEventListener('DOMContentLoaded', function() {
        const statusButtons = document.querySelectorAll('#acceptedModal .status-options button');

        statusButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active from all buttons in this modal
                document.querySelectorAll('#acceptedModal .status-options button').forEach(btn => {
                    btn.classList.remove('active');
                });
                // Add active to clicked button
                this.classList.add('active');
            });
        });
    });

    // Open update confirmation modal
    function openUpdateRequest() {
        const acceptedModal = document.getElementById('acceptedModal');
        const activeStatusBtn = acceptedModal.querySelector('.status-options button.active');

        if (!activeStatusBtn) {
            alert('Please select a status');
            return;
        }

        const newStatus = activeStatusBtn.dataset.status;
        const requestId = acceptedModal.dataset.requestId;

        // Store data in update modal
        const updateModal = document.getElementById('updateModal');
        updateModal.dataset.requestId = requestId;
        updateModal.dataset.status = newStatus;

        // Show confirmation modal
        document.getElementById('acceptedModal').style.display = 'none';
        document.getElementById('updateModal').style.display = 'flex';
    }

    // Confirm update and submit to backend
    function confirmUpdateRequest() {
        const modal = document.getElementById('updateModal');
        const requestId = modal.dataset.requestId;
        const status = modal.dataset.status;

        // Create form and submit
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/collector/request/${requestId}/update`;

        // CSRF token
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);

        // Status
        const statusInput = document.createElement('input');
        statusInput.type = 'hidden';
        statusInput.name = 'status';
        statusInput.value = status;
        form.appendChild(statusInput);

        document.body.appendChild(form);
        form.submit();
    }

    function closeUpdateConfirmModal() {
        document.getElementById('updateModal').style.display = 'none';
        document.getElementById('acceptedModal').style.display = 'flex';
    }

    function closeUpdateSuccessModal() {
        document.getElementById('updateSuccessModal').style.display = 'none';
        window.location.reload();
    }
</script>

@if(session('show_update_success_modal'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('updateSuccessModal').style.display = 'flex';
    });
</script>
@endif