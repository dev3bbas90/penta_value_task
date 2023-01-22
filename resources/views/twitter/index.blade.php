@extends('layouts.app')

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.min.css">
@endsection
@section('content')
<div class="w-100">

    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
        <div class="grid grid-cols-12 m-3">
            <!--begin::Card-->
            <div class="card card-custom" style="background-color: e4e0e3">
                <div class="card-header row mt-4">

                    <div class="card-body">
                        <form class="form" method="POST" action="{{route('twitter.fetch')}}" enctype="multipart/form-data">
                            @csrf
                            <h3 class="text-center">
                                Fetch Tweets
                            </h3>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="quert" class="form-label">Url</label>
                                        <input type="url" name="tw_url" id="text" required value="https://api.twitter.com/2/tweets/search/recent" class="form-control" placeholder="Enter search keyword here ...">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="quert" class="form-label">max Result</label>
                                        <input type="mumber" name="tw_max" id="tw_max" value="1000"  class="form-control" placeholder="Enter search keyword here ...">
                                    </div>
                                </div>
                                <div class="col-9">
                                    <div class="form-group">
                                        <label for="quert" class="form-label">Query</label>
                                        <input type="text" name="text" id="text" value="" class="form-control" placeholder="Enter search keyword here ...">
                                    </div>
                                </div>
                                <div class="col-3 text-center pt-2">
                                    <button type="submit" class="btn btn-primary mt-4">Pull Tweets</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr class="w-100">
                    <div class="card-title ">
                        <span class="card-icon">
                            <i class="fas fa-envelope-open-text"></i>
                        </span>
                        <h3 class="card-label text-center">
                           Tweets
                        </h3>
                    </div>
                    <div class="card-toolbar">

                    </div>
                </div>

                <div class="card-body card-body-main">
                    <!--begin: Datatable-->
                    <table class="table table-separate table-head-custom collapsed" id="requests_table">
                        <thead>
                            <tr>
                                <th>{{ __('Text') }}</th>
                                <th>{{ __('User_id') }}</th>
                                <th>{{ __('Created_at') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <!--end: Datatable-->
                </div>
            </div>
            <!--end::Card-->
        </div>
    </div>

</div>
@endsection
@section('scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>

    <script>
        let table;
        function initDatatable(url) {
            return $('#requests_table').DataTable({
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: {
                    url: url,
                    type: 'GET',
                },
                order: [
                    [2, 'desc']
                ],
                lengthMenu: [
                    [20, 30, 40, 50, 100, 1000],
                    [20, 30, 40, 50, 100, 1000]
                ],
                pageLength: 10,
                dom: `<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager row'lp>>`,
                buttons: [
                ],
                select: {
                    style: 'os',
                    selector: 'td:first-child'
                },
                order: [],
                columns: [
                    // {
                    //     data: "id",
                    //     name: "id",
                    //     searchable: true,
                    //     className: 'dt-center'
                    // },
                    {
                        data: "text",
                        searchable: false,
                        className: 'dt-center'
                    },
                    {
                        data: "user_id",
                        searchable: true,
                        className: 'dt-center'
                    },
                    {
                        data: "created_at",
                        searchable: true,
                        className: 'dt-center',
                    },
                ],
            });
        }
        $(document).ready(function() {

            table = initDatatable("{{ route('twitter.data') }}");
        });

    </script>
@endsection

