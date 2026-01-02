@extends('layouts.collector_request')
@section('title', 'Collector Request')
@section('content')

<div class="min-h-screen flex flex-col p-2">

    <!-- TOP CONTAINER -->
    <div class="mx-auto max-w-4xl w-full px-2">
        <div class="row-top row-top justify-content-center mb-2">
            <h1 class="font-extrabold" style="color: var(--color-dark-green) ">Request to Approve</h1>
        </div>

        <!-- REQUEST TO APPROVE -->
        <div id="topCarousel" class="carousel slide" data-bs-wrap="false">
            <div class="carousel-inner mb-2">
                <!-- 1ST SLIDE -->
                <div class="carousel-item active">
                    <div class="row g-3">

                        <!-- CARDS -->
                        <div class="col-6 col-md-6">
                            <div class="card card-top h-100">
                                <div class="card-top-details">
                                    <div class="card-top-circle-date">
                                        <div class="circle-top">
                                            <img src="{{ asset('icons/O_recycle.png') }}" class="wastes-img-top">
                                        </div>
                                        <h2 class="card-top-text-date">JAN 01</h2>
                                    </div>
                                    <div class="card-top-data">
                                        <h5 class="card-top-title">John Doe</h5>
                                        <p class="card-top-text"><b>Waste Type:</b> Recyclable</p>
                                        <p class="card-top-text"><b>Qty:</b> {1kg}</p>
                                    </div>
                                </div>
                                <button type="button"
                                    class="card-top-button"
                                    onclick="openRequestModal(this)"
                                    data-reqname="John Doe"
                                    data-reqbrgy="Brgy. 123"
                                    data-reqwaste="Recyclable"
                                    data-reqquantity="1kg"
                                    data-reqdate="January 1, 2025"
                                    data-reqtime="10:00 AM">
                                    View Details
                                </button>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="card card-top h-100">
                                <div class="card-top-details">
                                    <div class="card-top-circle-date">
                                        <div class="circle-top">
                                            <img src="{{ asset('icons/O_recycle.png') }}" class="wastes-img-top">
                                        </div>
                                        <h2 class="card-top-text-date">JAN 01</h2>
                                    </div>
                                    <div class="card-top-data">
                                        <h5 class="card-top-title">John Doe</h5>
                                        <p class="card-top-text"><b>Waste Type:</b> Recyclable</p>
                                        <p class="card-top-text"><b>Qty:</b> {1kg}</p>
                                    </div>
                                </div>
                                <button type="button"
                                    class="card-top-button"
                                    onclick="openRequestModal(this)"
                                    data-reqname="John Doe"
                                    data-reqbrgy="Brgy. 123"
                                    data-reqwaste="Recyclable"
                                    data-reqquantity="1kg"
                                    data-reqdate="January 1, 2025"
                                    data-reqtime="10:00 AM">
                                    View Details
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- 2ND SLIDE -->
                <div class="carousel-item">
                    <div class="row g-3">
                        <!-- CARDS -->
                        <div class="col-6 col-md-6">
                            <div class="card card-top h-100">
                                <div class="card-top-details">
                                    <div class="card-top-circle-date">
                                        <div class="circle-top">
                                            <img src="{{ asset('icons/O_recycle.png') }}" class="wastes-img-top">
                                        </div>
                                        <h2 class="card-top-text-date">JAN 01</h2>
                                    </div>
                                    <div class="card-top-data">
                                        <h5 class="card-top-title">John Doe</h5>
                                        <p class="card-top-text"><b>Waste Type:</b> Recyclable</p>
                                        <p class="card-top-text"><b>Qty:</b> {1kg}</p>
                                    </div>
                                </div>
                                <button type="button"
                                    class="card-top-button"
                                    onclick="openRequestModal(this)"
                                    data-reqname="John Doe"
                                    data-reqbrgy="Brgy. 123"
                                    data-reqwaste="Recyclable"
                                    data-reqquantity="1kg"
                                    data-reqdate="January 1, 2025"
                                    data-reqtime="10:00 AM">
                                    View Details
                                </button>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="card card-top h-100">
                                <div class="card-top-details">
                                    <div class="card-top-circle-date">
                                        <div class="circle-top">
                                            <img src="{{ asset('icons/O_recycle.png') }}" class="wastes-img-top">
                                        </div>
                                        <h2 class="card-top-text-date">JAN 01</h2>
                                    </div>
                                    <div class="card-top-data">
                                        <h5 class="card-top-title">John Doe</h5>
                                        <p class="card-top-text"><b>Waste Type:</b> Recyclable</p>
                                        <p class="card-top-text"><b>Qty:</b> {1kg}</p>
                                    </div>
                                </div>
                                <button type="button"
                                    class="card-top-button"
                                    onclick="openRequestModal(this)"
                                    data-reqname="John Doe"
                                    data-reqbrgy="Brgy. 123"
                                    data-reqwaste="Recyclable"
                                    data-reqquantity="1kg"
                                    data-reqdate="January 1, 2025"
                                    data-reqtime="10:00 AM">
                                    View Details
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- BUTTONS -->
            <button class="top-carousel-control-prev" type="button" data-bs-target="#topCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="top-carousel-control-next" type="button" data-bs-target="#topCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

            <div class="carousel-indicators">
                <button type="button" data-bs-target="#topCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#topCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            </div>
        </div>

        <!-- MID CONTAINER -->
        <div class="mx-auto max-w-4xl w-full px-2">
            <div class="row-mid justify-content-center">
                <h2 class="font-extrabold" style="color: var(--color-dark-green) ">Accepted Request</h2>
            </div>

            <!-- COLLECTION SCHEDULE -->
            <div id="midCarousel" class="carousel slide" data-bs-wrap="false">
                <div class="carousel-inner mb-2">
                    <!-- 1ST SLIDE -->
                    <div class="carousel-item active">
                        <div class="row g-3">

                            <!-- CARDS -->
                            <div class="col-6 col-md-6">
                                <div class="card card-mid h-100">
                                    <div class="card-mid-details">
                                        <div class="card-mid-circle-date">
                                            <div class="circle-mid">
                                                <img src="{{ asset('icons/DG_recycle.png') }}" class="wastes-img-mid">
                                            </div>
                                            <h2 class="card-mid-text-date">JAN 01</h2>
                                        </div>
                                        <div class="card-mid-data">
                                            <h5 class="card-mid-title">John Doe</h5>
                                            <p class="card-mid-text"><b>Waste Type:</b> Recyclable</p>
                                            <p class="card-mid-text"><b>Qty:</b> {1kg}</p>
                                        </div>
                                    </div>
                                    <button type="button"
                                        class="card-mid-button"
                                        onclick="openAcceptedModal(this)"
                                        data-accname="John Doe"
                                        data-accbrgy="Brgy. 123"
                                        data-accwaste="Recyclable"
                                        data-accquantity="1kg"
                                        data-accdate="January 1, 2025"
                                        data-acctime="10:00 AM"
                                        data-acctruck="ABC 1234 (5-ton capacity)">
                                        View Details
                                    </button>
                                </div>
                            </div>

                            <div class="col-6 col-md-6">
                                <div class="card card-mid h-100">
                                    <div class="card-mid-details">
                                        <div class="card-mid-circle-date">
                                            <div class="circle-mid">
                                                <img src="{{ asset('icons/DG_recycle.png') }}" class="wastes-img-mid">
                                            </div>
                                            <h2 class="card-mid-text-date">JAN 01</h2>
                                        </div>
                                        <div class="card-mid-data">
                                            <h5 class="card-mid-title">John Doe</h5>
                                            <p class="card-mid-text"><b>Waste Type:</b> Recyclable</p>
                                            <p class="card-mid-text"><b>Qty:</b> {1kg}</p>
                                        </div>
                                    </div>
                                    <button type="button"
                                        class="card-mid-button"
                                        onclick="openAcceptedModal(this)"
                                        data-accname="John Doe"
                                        data-accbrgy="Brgy. 123"
                                        data-accwaste="Recyclable"
                                        data-accquantity="1kg"
                                        data-accdate="January 1, 2025"
                                        data-acctime="10:00 AM"
                                        data-acctruck="ABC 1234 (5-ton capacity)">
                                        View Details
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- 2ND SLIDE -->
                    <div class="carousel-item">
                        <div class="row g-3">

                            <!-- CARDS -->
                            <div class="col-6 col-md-6">
                                <div class="card card-mid h-100">
                                    <div class="card-mid-details">
                                        <div class="card-mid-circle-date">
                                            <div class="circle-mid">
                                                <img src="{{ asset('icons/DG_recycle.png') }}" class="wastes-img-mid">
                                            </div>
                                            <h2 class="card-mid-text-date">JAN 01</h2>
                                        </div>
                                        <div class="card-mid-data">
                                            <h5 class="card-mid-title">John Doe</h5>
                                            <p class="card-mid-text"><b>Waste Type:</b> Recyclable</p>
                                            <p class="card-mid-text"><b>Qty:</b> {1kg}</p>
                                        </div>
                                    </div>
                                    <button type="button"
                                        class="card-mid-button"
                                        onclick="openAcceptedModal(this)"
                                        data-accname="John Doe"
                                        data-accbrgy="Brgy. 123"
                                        data-accwaste="Recyclable"
                                        data-accquantity="1kg"
                                        data-accdate="January 1, 2025"
                                        data-acctime="10:00 AM"
                                        data-acctruck="ABC 1234 (5-ton capacity)">
                                        View Details
                                    </button>
                                </div>
                            </div>

                            <div class="col-6 col-md-6">
                                <div class="card card-mid h-100">
                                    <div class="card-mid-details">
                                        <div class="card-mid-circle-date">
                                            <div class="circle-mid">
                                                <img src="{{ asset('icons/DG_recycle.png') }}" class="wastes-img-mid">
                                            </div>
                                            <h2 class="card-mid-text-date">JAN 01</h2>
                                        </div>
                                        <div class="card-mid-data">
                                            <h5 class="card-mid-title">John Doe</h5>
                                            <p class="card-mid-text"><b>Waste Type:</b> Recyclable</p>
                                            <p class="card-mid-text"><b>Qty:</b> {1kg}</p>
                                        </div>
                                    </div>
                                    <button type="button"
                                        class="card-mid-button"
                                        onclick="openAcceptedModal(this)"
                                        data-accname="John Doe"
                                        data-accbrgy="Brgy. 123"
                                        data-accwaste="Recyclable"
                                        data-accquantity="1kg"
                                        data-accdate="January 1, 2025"
                                        data-acctime="10:00 AM"
                                        data-acctruck="ABC 1234 (5-ton capacity)">
                                        View Details
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- BUTTONS -->
                <button class="mid-carousel-control-prev" type="button" data-bs-target="#midCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="mid-carousel-control-next" type="button" data-bs-target="#midCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#midCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#midCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                </div>
            </div>
        </div>
    </div>

    <!-- BOTTOM CONTAINER -->
    <div class="mx-auto max-w-4xl w-full px-2">
        <div class="row-mid justify-content-center">
            <div class="col">
                <!-- COMPLETED REQUEST -->
                <div class="card-bot">
                    <div class="card-header-with-link">
                        <h2 class="font-extrabold" style="color: var(--color-light-olive) ">Completed Request</h2>
                    </div>

                    <!-- CARDS -->
                    <div class="card-req">
                        <div class="col">
                            <div class="card-data-box-req">
                                <div class="circle">
                                    <img src="{{ asset('icons/C_recycle.png') }}" class="waste-img-bot">
                                </div>
                                <div class="card-req-info">
                                    <h2 class="card-req-text-name">John Doe</h2>
                                    <p class="card-req-text-wk">Recyclable, 1kg</p>
                                </div>
                                <div class="card-req-right">
                                    <p class="card-req-text-date">01/01/25</p>
                                    <button type="button" class="btn-completed">Completed</button>
                                </div>
                            </div>
                            <div class="card-data-box-req">
                                <div class="circle">
                                    <img src="{{ asset('icons/C_bio.png') }}" class="waste-img-bot">
                                </div>
                                <div class="card-req-info">
                                    <h2 class="card-req-text-name">John Doe</h2>
                                    <p class="card-req-text-wk">Biodegradable, 1kg</p>
                                </div>
                                <div class="card-req-right">
                                    <p class="card-req-text-date">01/01/25</p>
                                    <button type="button" class="btn-completed">Completed</button>
                                </div>
                            </div>
                            <div class="card-data-box-req">
                                <div class="circle">
                                    <img src="{{ asset('icons/C_nonbio.png') }}" class="waste-img-bot">
                                </div>
                                <div class="card-req-info">
                                    <h2 class="card-req-text-name">John Doe</h2>
                                    <p class="card-req-text-wk">Non-Biodegradable, 1kg</p>
                                </div>
                                <div class="card-req-right">
                                    <p class="card-req-text-date">01/01/25</p>
                                    <button type="button" class="btn-completed">Completed</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openRequestModal(button) {
        console.log('Opening modal...');
        console.log('Button data:', button.dataset);

        document.getElementById('reqname').value = button.dataset.reqname || '';
        document.getElementById('reqbrgy').value = button.dataset.reqbrgy || '';
        document.getElementById('reqwaste').value = button.dataset.reqwaste || '';
        document.getElementById('reqquantity').value = button.dataset.reqquantity || '';
        document.getElementById('reqdate').value = button.dataset.reqdate || '';
        document.getElementById('reqtime').value = button.dataset.reqtime || '';

        const modal = document.getElementById('requestModal');
        modal.style.display = 'flex';

        console.log('Modal displayed');
    }

    function closeRequestModal() {
        console.log('Closing modal...');
        const modal = document.getElementById('requestModal');
        modal.style.display = 'none';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('requestModal');
        if (event.target == modal) {
            closeRequestModal();
        }
    }

    function openAcceptedModal(button) {
        console.log('Opening modal...');
        console.log('Button data:', button.dataset);

        document.getElementById('accname').value = button.dataset.accname || '';
        document.getElementById('accbrgy').value = button.dataset.accbrgy || '';
        document.getElementById('accwaste').value = button.dataset.accwaste || '';
        document.getElementById('accquantity').value = button.dataset.accquantity || '';
        document.getElementById('accdate').value = button.dataset.accdate || '';
        document.getElementById('acctime').value = button.dataset.acctime || '';

        const modal = document.getElementById('acceptedModal');
        modal.style.display = 'flex';

        console.log('Modal displayed');
    }

    function closeAcceptedModal() {
        console.log('Closing modal...');
        const modal = document.getElementById('acceptedModal');
        modal.style.display = 'none';
    }

    window.onclick = function(event) {
        const modal = document.getElementById('acceptedModal');
        if (event.target == modal) {
            closeAcceptedModal();
        }
    }

    document.addEventListener('DOMContentLoaded', () => {
        const statusButtons = document.querySelectorAll(
            '.sched-status-completed, .sched-status-inprogress, .sched-status-assigned, .sched-status-cancelled'
        );

        statusButtons.forEach(button => {
            button.addEventListener('click', () => {
                statusButtons.forEach(btn => btn.classList.remove('active'));

                button.classList.add('active');
            });
        });
    });
</script>
@endpush