<!-- REQUEST DETAILS MODAL -->
<div id="requestModal" class="modal-overlay" style="display: none;">
    <div class="modal-popup">
        <button class="modal-close-btn" onclick="closeRequestModal()">&times;</button>

        <form id="acceptRequestForm" method="POST" action="">
            @csrf
            <div class="row justify-content-center mb-4 mt-2">
                <img src="{{ asset('icons/truck.png') }}" class="truck-img">
                <h2 class="font-extrabold" style="color: var(--color-dark-green)">Request Details</h2>
            </div>

            <div class="card-field-nr">
                <label>Name</label>
                <input id="reqname" type="text" class="form-control" value="" readonly>
            </div>

            <div class="card-field-nr mb-2">
                <label>Resident</label>
                <input id="reqbrgy" type="text" class="form-control" value="" readonly>
            </div>

            <div class="form-row-container">
                <div class="card-field-wq mb-2">
                    <label class="form-label">Waste Type</label>
                    <input id="reqwaste" type="text" class="form-control" value="" readonly>
                </div>

                <div class="card-field-wq mb-2">
                    <label class="form-label">Quantity</label>
                    <input id="reqquantity" type="text" class="form-control" value="" readonly>
                </div>
            </div>

            <div class="card-field-dt">
                <label>Preferred Date</label>
                <input id="reqdate" type="text" class="form-control" value="" readonly>
            </div>

            <div class="card-field-dt mb-8">
                <label>Preferred Time</label>
                <input id="reqtime" type="text" class="form-control" value="" readonly>
            </div>

            <hr class="my-2">

            <label class="font-extrabold" style="color: var(--color-dark-green)">Assigned Truck</label>

            <div class="card-field-t">
                <label>Select Truck <span style="color: red;">*</span></label>
                <select id="reqtruck" name="license_plate" class="form-control" required>
                    <option value="">-- Select Truck --</option>
                </select>
            </div>

            <div class="action-buttons mt-16">
                <button type="button" id="acceptButton" class="btn-accept" onclick="showConfirmation()">
                    Accept
                </button>
                <button type="button" class="btn-decline" onclick="closeRequestModal()">Decline</button>
            </div>
        </form>
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
    .truck-img {
        width: 100px;
        height: 100px;

        padding: 0.25rem;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 0.25rem;
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

    .btn-accept,
    .btn-decline {
        width: 100px;
        padding: 10px 24px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: bold;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.25);
    }

    .btn-accept {
        background-image: linear-gradient(to top, #ff9100, #FFA733);
        color: white;
    }

    .btn-decline {
        background: var(--color-cream);
        color: var(--color-orange);
        border: 2px solid;
        border-color: var(--color-orange);
    }

    .btn-accept:active,
    .btn-decline:active {
        animation: push 0.2s ease-in-out;
    }

    .btn-accept,
    .btn-decline {
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

    .btn-accept:active,
    .btn-decline:active {
        top: 3px;
        box-shadow: 0 2px 0px var(--color-orange);
        transition: all 0.2s;
    }


    /* Make sure buttons are clickable */
    .btn-details {
        cursor: pointer;
        pointer-events: auto;
        z-index: 10;
        position: relative;
    }
</style>

<script>
    function openAcceptUpdRequest() {
        document.getElementById('requestModal').style.display = 'none';
        document.getElementById('confirmModal').style.display = 'flex';
    }

    function closeRequestUpdModal() {
        document.getElementById('requestModal').style.display = 'none';
    }
</script>