<!-- ACCEPTED REQUEST DETAILS MODAL -->
<div id="acceptedModal" class="modal-overlay" style="display: none;">
    <div class="modal-popup">
        <button class="modal-close-btn" onclick="closeAcceptedModal()">&times;</button>

        <div class="row justify-content-center mb-4 mt-2">
            <div class="modal-circle">
            </div>
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
            <input id="acctime" type="text" class="form-control" placeholder="" readonly>
        </div>

        <div class="card-field-t">
            <label>Assigned Truck</label>
            <select id="acctruck" disabled>
                <option>ABC 1234 (5-ton capacity)</option>
                <option>DEF 9981 (10-ton capacity)</option>
                <option>XYZ 5561 (8-ton capacity)</option>
            </select>
        </div>

        <hr class="my-3">
        <div class="update-status-card">
            <h4 class="update-title">Update Status</h4>
            <!-- STATUS OPTIONS -->
            <div class="status-options mb-4">
                <button type="button" class="sched-status-assigned" data-status="assigned">
                    Assigned
                </button>

                <button type="button" class="sched-status-cancelled" data-status="cancelled">
                    Cancelled
                </button>

                <button type="button" class="sched-status-inprogress" data-status="in_progress">
                    In Progress
                </button>

                <button type="button" class="sched-status-completed" data-status="completed">
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

<style>
    :root {
        --color-dark-green: #1f4b2c;
        --color-mid-green: #4d7111;
        --color-orange: #ff9100;
        --color-light-olive: #d5ed9f;
        --color-cream: #fffbe6;

        --color-bg-completed: #f2f9e1;
        --color-bg-inprogress: #ffe9cc;
        --color-bg-assigned: #ffeccc;
        --color-bg-cancelled: #f7ddd9;

        --color-completed: #4d7111;
        --color-inprogress: #ff7b00;
        --color-assigned: #ffa813;
        --color-cancelled: #c2402a;
    }

    body {
        font-family: "Roboto", sans-serif;
    }

    label {
        font-size: 16px;
    }

    .modal-close-btn {
        position: absolute;
        top: 12px;
        right: 20px;
        background: transparent;
        border: none;
        font-size: 32px;
        cursor: pointer;
        color: var(--color-orange);
    }

    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgb(0, 0, 0, 0.50);
        backdrop-filter: blur(10px);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 999;
    }

    /* REQUEST DETAILS POPUP*/
    .modal-popup {
        width: 360px;
        height: 710px;
        background: var(--color-cream);
        padding: 24px;
        border-radius: 30px;
        font-size: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.25);
        justify-content: center;
        position: relative;
    }

    .modal-popup h2 {
        text-align: center;
    }

    /* CIRCLE IMAGE CONTAINER */
    .modal-circle {
        flex-shrink: 0;
        width: 80px;
        height: 80px;
        background-color: var(--color-orange);
        border-radius: 50%;
        padding: 0.5rem;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 0.75rem;
    }

    /* FORM INPUT CONTAINER*/
    .form-row-container {
        display: flex;
        gap: 24px;
        margin-top: 8px;
    }

    .card-field-nr,
    .card-field-wq,
    .card-field-dt,
    .card-field-t {
        font-weight: 500;
        display: flex;
        justify-content: center;
        margin-top: 8px;
    }

    .card-field-nr,
    .card-field-dt,
    .card-field-t {
        gap: 24px;
        align-items: center;
    }

    .card-field-wq {
        flex-direction: column;
    }

    .card-field-nr label,
    .card-field-wq label,
    .card-field-dt label,
    .card-field-t label {
        min-width: 80px;
        font-size: 12px;
    }

    /* Inputs and selects */
    .card-field-nr input,
    .card-field-wq input,
    .card-field-dt input,
    .card-field-t select {
        flex: 1;
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 12px;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 16px;
    }

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

    /* INDIVIDUAL (SMALL) CONTAINER: SCHED STATUS */
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
    }

    .card-sched-status {
        display: block;
        padding: 0.25rem 1rem;
        text-align: center;
        border-radius: 50px;
        margin-bottom: 4px;
    }

    /* COMPLETED CONTAINER */
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

    /* IN PROGRESS CONTAINER */
    .sched-status-inprogress {
        background-color: var(--color-inprogress);
    }

    .sched-status-inprogress.active {
        border: 2px solid;
        background-color: var(--color-bg-inprogress);
        border-color: var(--color-inprogress);
    }

    /* ASSIGNED CONTAINER */
    .sched-status-assigned {
        background-color: var(--color-assigned);
    }

    .sched-status-assigned.active {
        border: 2px solid;
        background-color: var(--color-bg-assigned);
        border-color: var(--color-assigned);
    }

    /* CANCELLED CONTAINER */
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

    .status-actions {
        display: flex;
        justify-content: center;
        gap: 16px;
    }

    .btn-update {
        background-image: linear-gradient(to top, #ff9100, #FFA733);
        color: white;
    }

    .btn-cancel {
        background: var(--color-cream);
        color: var(--color-orange);
        border: 2px solid;
        border-color: var(--color-orange);
    }

    .btn-update,
    .btn-cancel {
        width: 100px;
        padding: 10px 24px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: bold;
        cursor: pointer;

        position: relative;
        top: 0;
        display: inline-block;

        box-shadow: 0 0 5px rgba(0, 0, 0, 0.25);
        transition: all 0.2s ease;
    }

    .btn-update:active,
    .btn-cancel:active {
        top: 3px;
        box-shadow: 0 2px 0px var(--color-orange);
        transition: all 0.2s;
    }

    /* Make sure buttons are clickable */
    .card-mid-button {
        cursor: pointer;
        pointer-events: auto;
        z-index: 10;
        position: relative;
    }
</style>

<script>
    function openUpdateRequest() {
        document.getElementById('acceptedModal').style.display = 'none';
        document.getElementById('updateModal').style.display = 'flex';
    }
</script>