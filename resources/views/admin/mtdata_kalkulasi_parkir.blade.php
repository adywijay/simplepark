@extends('admin.page.kerangka_panggil')
@section('list_content')
    <div class="row">
        <div id="man" class="col s12">
            <div class="card material-table" style="border-radius: 5px;">
                <div class="table-header">
                    <span class="table-title">
                        Rincian Biaya Parkir</span>
                    <div class="actions">
                        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i
                                class="material-icons">search</i></a>
                    </div>
                </div>
                <table id="datatable" class="responsive-table" style="text-align:center;">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Parkir Id</th>
                            <th>Biaya Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @csrf
                        @foreach ($call as $isi)
                            <tr id="jid{{ $isi->id }}">
                                <td>{{ $isi->id }}</td>
                                <td>{{ $isi->parkir_id}}</td>
                                <td>{{ $isi->biaya_total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
