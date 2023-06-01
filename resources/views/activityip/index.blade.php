@extends('layouts.admin')
@section('content')
    <h1> Activity IPs</h1>

    @if (Session::has('message'))
    <div class="alert alert-info">{{ session('message') }}</div>
    @endif

    <form action="" method="get">
        @csrf

        <div class="d-flex align-items-center">


            <div class="p-2">
                From
            </div>
            <div class="p-2">
                <input name="from_date" type="date" value="{{ $from_date }}" />
            </div>
            <div class="p-2">
                To
            </div>
            <div class="p-2">
                <input name="to_date" type="date" value="{{ $to_date }}" />
            </div>


            <div class="pt-2 pb-2">
                <button class="btn btn-default" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>


        </div>

    </form>

    @include('layouts.partials.paginate_info', ['paginator' => $ips, 'label' => 'ips'])



    @php
    $i = 0;
    @endphp

    @foreach ($ips as $ip)
        <div class="row">



            <div class="col-sm-2 ip_address">
                <a href="{{route("activity-logs.index")}}?ip={{$ip->ip}}" target="_blank">  {{ $ip->ip }}</a>


            </div>
            <div class="col-sm-1">

                {{ $ip->cnt }}

            </div>

            <div class="col-sm-3" id="country{{ $i }}">

                Country:

            </div>

            <div class="col-sm-3" id="region{{ $i }}">

                Region:

            </div>

            <div class="col-sm-3" id="city{{ $i }}">

                City:

            </div>

        </div>

        @php
            $i++;
        @endphp
    @endforeach
    @include('layouts.partials.paginate_info', ['paginator' => $ips, 'label' => 'ips'])

    <script>
        $(document).ready(function() {


            $('div.ip_address').each(function(index, value) {
                console.log(`div${index}:${value.innerText}`);
               var url = `{{ env('IP2LOCATION_SRV_URL', 'https://appmgrsrv.babulmirdha.com') }}/api/ip2locations/${value.innerText}`
                $.ajax({
                    url: url
                }).then(function(data) {

                    $("#country" + index).text(data.data.country)
                    $("#city" + index).text(data.data.city)
                    $("#region" + index).text(data.data.region)

                });

            });


        });
    </script>
@endsection
