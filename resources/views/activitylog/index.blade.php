<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Activity Logs') }}
        </h2>
    </x-slot>

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
            <div class="p-2">
                <input name="term" type="text" value="{{ $term }}"
                    placeholder="User Name or IP adddress" />
            </div>

            <div class="pt-2 pb-2">
                <button class="btn btn-default" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>


        </div>

    </form>

    @include('layouts.partials.paginate_info', ['paginator' => $logs, 'label' => 'logs'])


    @php
        $i = 0;
    @endphp

    @foreach ($logs as $key => $log)
        <div class="card">

            <div class="card-body">


                <div class="d-flex justify-content-between">


                    <div>

                        @php
                            $user = $log->user;
                        @endphp

                        @if ($user && $user->photo_url)
                            <img class="rounded-circle" src="{{ asset("$user->photo_url") }}" width="64"
                                height="64" />


                            <a href="{{ route('users.show', $user->id) }}">{{ $user->first_name }}
                                {{ $user->surname }}</a>
                        @else
                            Not Available
                        @endif

                        ({{ $log->created_at->diffForHumans() }})
                        <br>

                        <span class="{{ \App\Utils\ColorUtils::getColorCodeForHttpMethod($log->method) }}">
                            {{ $log->method }}
                        </span>
                        Url: {{ $log->url }}
                        => {{ $log->class }}<span>@</span>{{ $log->function }}, Line: {{ $log->line }}

                        @if ($log->tags)
                            <br> Tags: {{ $log->tags }}
                        @endif

                    </div>



                </div>


                <div>


                    <br>
                    <div>
                        Data: {{ $log->data }}
                    </div>
                    <br>

                    <div>
                        Agent: {{ $log->agent }}
                    </div>

                    <br>
                    <div>

                        <div id="country{{ $i }}">Country</div>
                        <div id="city{{ $i }}">City</div>
                        <div id="region{{ $i }}">Region</div>
                        IP:<span class="text-danger ip_address">{{ $log->ip }}</span>

                    </div>

                </div>


            </div>
        </div>

        <br>

        @php
            $i++;
        @endphp
    @endforeach
    @include('layouts.partials.paginate_info', ['paginator' => $logs, 'label' => 'logs'])

    <script>
        $(document).ready(function() {


            $('span.ip_address').each(function(index, value) {
                console.log(`div${index}:${value.innerText}`);
                var url =
                    `{{ env('IP2LOCATION_SRV_URL', 'https://appmgrsrv.babulmirdha.com') }}/api/ip2locations/${value.innerText}`
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
</x-admin-layout>
