@extends('layouts.master')

@section('title', 'Buses | Lam - School Management App')

@section('title-topbar', 'Buses')

<!-- css insert -->
@section('css')

<!-- select 2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/css/select2.min.css"
    integrity="sha512-aD9ophpFQ61nFZP6hXYu4Q/b/USW7rpLCQLX6Bi0WJHXNO7Js/fUENpBQf/+P4NtpzNX0jSgR5zVvPOJp+W2Kg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

@endsection

<!-- content insert -->
@section('content')

<div class="container-fluid px-0 px-md-2 mt-3">

    <!-- page title link -->
    <div class="d-sm-flex align-items-center justify-content-between mb-3">
        <span class="mb-0">
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.home') }}">{{ __('basic.dashboard') }}
                |</a>
            <a class="link-cust-text text-gray-200 fw-light" href="{{ route('sett.buses.index') }}">Pulses
                Buses |
            </a>
            <a class="text-gray-300">{{ __('basic.buses') }}</a>
        </span>
    </div>

    <div class="card card-input shadow mb-3 pb-3">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 fw-bold text-gray-500"><i class="fas fa-capsules me-1"></i>
                {{ __('basic.buses') }}</h6>
        </div>


        <!-- Card Body -->
        <div class="card-body px-4 px-md-5">

            <form id="myform" method="POST" action="{{ route('sett.buses.store') }}">

                @csrf

                <div class="row mb-1 justify-content-center">

                    <div class="col-12 col-md-10 col-lg-7">
                        <div class="row">

                            <div class="col-12 mb-3">
                                <label class="form-label">{{ __('basic.name') }}
                                    <small>({{ __('basic.required') }})</small></label>
                                <input name="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Bus Name.." required>

                                @error('name')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label">{{ __('basic.seats') }}
                                    <small>({{ __('basic.required') }})</small></label>
                                <input name="seats" type="number"
                                    class="form-control @error('seats') is-invalid @enderror" placeholder="Bus Seats.."
                                    required>

                                @error('seats')
                                <span class="error-msg-form">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12 mb-3">
                            <label class="form-label">{{ __('basic.bus chart') }}
                                <small>({{ __('basic.required') }})</small></label>
                            <select id="bus_chart"
                                class="js-example-basic-single select2-hidden-accessible @error('bus_chart') is-invalid @enderror"
                                name="bus_chart" required>
                                <option value="bus_49">bus_49</option>
                                <option value="bus_14">bus_14</option>
                                <option value="limo_4">limo_4</option>
                            </select>
                            <div id="bus_chart-js-error-valid"></div>

                            @error('bus_chart')
                            <span class="error-msg-form">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4 mb-2">
                    <input type="submit" name="next" class="next-form-steps btn btn-primary action-button-next"
                        value="{{ __('basic.send') }}">
                </div>

            </form>
        </div>

    </div>

</div>

@endsection

<!-- js insert -->
@section('js')

<!-- select 2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0-rc.0/js/select2.min.js"
    integrity="sha512-4MvcHwcbqXKUHB6Lx3Zb5CEAVoE9u84qN+ZSMM6s7z8IeJriExrV3ND5zRze9mxNlABJ6k864P/Vl8m0Sd3DtQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function() {
            $('.js-example-basic-single').select2();
            //hide search
            $('.select2-no-search').select2({
                minimumResultsForSearch: -1
            });
        });
</script>

<!-- validate jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
    integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    //Rules for the Validator plugin
        var $validator = $('#myform').validate({
            rules: {
                name: {
                    minlength: 3,
                },
            },
            messages: {
                email: {
                    required: "We need your email address to contact you",
                    email: "Your email address must be in the format of name@domain.com"
                },
                password_confirmation: {
                    equalTo: "Password does not match",
                }
            },
            //for inserting erros for some inputs that makes posation problem such as selector 2 and bt datapicker
            errorPlacement: function(error, element) {
                switch (element.attr("name")) {
                    case 'role':
                        error.insertAfter($("#role-js-error-valid"));
                        break;
                    case 'gendar':
                        error.insertAfter($("#gendar-js-error-valid"));
                        break;
                    default:
                        error.insertAfter(element);
                }

            },
        });
</script>

@endsection