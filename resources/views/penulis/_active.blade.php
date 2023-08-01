<div class="row">
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-uppercase font-weight-bold text-success">FEE</p>
                            <h5 class="font-weight-bolder">
                                Rp {{ format_uang($fee) }}
                            </h5>
                            <p class="mb-0">
                                &nbsp;
                            </p>
                            <p class="mb-0">
                                &nbsp;
                            </p>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                            <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            {{-- <p class="text-sm mb-0 text-uppercase font-weight-bold">ORDER</p> --}}
                            <h5 class="font-weight-bolder">
                                ORDER
                            </h5>
                            <p class="mb-0">
                                <span class="text-primary text-sm font-weight-bolder">PAID</span>
                                <span class="font-weight-bolder">{{ $paid }}</span>
                            </p>
                            <p class="mb-0">
                                <span class="text-warning text-sm font-weight-bolder">ON PROGRESS</span>
                                <span class="font-weight-bolder">{{ $onprogress }}</span>
                            </p>
                            <p class="mb-0">
                                <span class="text-success text-sm font-weight-bolder">DONE</span>
                                <span class="font-weight-bolder">{{ $done }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                            <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            {{-- <p class="text-sm mb-0 text-uppercase font-weight-bold">INVOICE</p> --}}
                            <h5 class="font-weight-bolder">
                                INVOICE
                            </h5>
                            <p class="mb-0">
                                <span class="text-warning text-sm font-weight-bolder">PENDING</span>
                                <span class="font-weight-bolder">{{ $invoice['pending'] }}</span>
                            </p>
                            <p class="mb-0">
                                <span class="text-success text-sm font-weight-bolder">PAID</span>
                                <span class="font-weight-bolder">{{ $invoice['paid'] }}</span>
                            </p>
                            <p class="mb-0">
                                &nbsp;
                            </p>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                            <i class="ni ni-credit-card text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
