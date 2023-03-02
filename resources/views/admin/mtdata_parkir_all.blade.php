@extends('admin.page.kerangka_panggil')
@section('list_content')
    <div class="row">
        <div id="man" class="col s12">
            <div class="card material-table" style="border-radius: 5px;">
                <div class="table-header">
                    <span class="table-title">
                        Registrasi Parkir</span>
                    <div class="actions">
                        {{-- href="javascript:void(0)" onclick="manualAddKdt()" --}}
                        <a href="javascript:void(0)" onclick="manualAddKdt()" class="modal-trigger btn-flat nopadding"><i
                                class="material-icons">group_add</i></a>
                        <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i
                                class="material-icons">search</i></a>
                    </div>
                </div>
                <table id="datatable" class="responsive-table" style="text-align:center;">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Durasi / Jam</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @csrf
                        @foreach ($call as $isi)
                            <tr id="jid{{ $isi->id }}">
                                <td>{{ $isi->id }}</td>
                                <td>{{ $isi->time_in}}</td>
                                <td>{{ $isi->time_out }}</td>
                                <td>{{ $isi->durasi}}</td>
                                <td>
                                        <a href="javascript:void(0)" onclick="kalkulasi({{ $isi->id }})"
                                            class="modal-trigger tooltipped btn-floating btn-small waves-effect waves-light blue nopadding" data-position="bottom" data-tooltip="Kalkulasi"><i
                                                class="medium material-icons white-text">attach_money</i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


            <!-- =============================== Start Modal 3 ================================= -->
            <div id="modal3" class="modal col s6 modal-fixed-footer">
                <nav class="orange darken-4">
                    <span class="card-title center-align"><i id="header-modal-3"></i></span>
                </nav>
                <br>
                <br>
                <form id="add-parkir">
                    @csrf
                    <div class="input-field col s6">
                        <input placeholder="Check In" name="time_in" id="time_in" type="datetime-local"
                            class="validate red-text">
                        <div>
                            <label id="time_in" for="time_in" class="red-text">Parkir. Masuk *</label>
                        </div>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="Check Out" name="time_out" id="time_out" type="datetime-local"
                            class="validate red-text">
                        <div>
                            <label id="time_out" for="time_out" class="red-text">Parkir. Keluar *</label>
                        </div>
                    </div>
                    <div class="modal-footer input-field col s12">
                        <div id="div" class="row center">
                            <button id="submit" class="btn waves-effect waves-light teal" type="submit">Simpan
                            </button>
                            <a href="javascript:void(0)" onclick="tutup3()"
                                class="btn waves-effect waves-light red">Close</a>
                        </div>
                    </div>
                </form>
            </div>
            <!-- =============================== End Modal 3 ================================= -->
        </div>
    </div>

    <script type='text/javascript'>
        function tutup() {
            $("#modal1").modal('close');
        }

        function manualAddKdt() {
            $('#modal3').modal('open');
            $('#header-modal-3').html("Form Registrasi Manual");
        }

        function tutup3() {
            $("#modal3").modal('close');
            $('#add-kdt-form').trigger("reset");
        }



        $('#add-parkir').on('submit', function(event) {
            event.preventDefault();

            var time_in = $('#time_in').val();
            var time_out = $('#time_out').val();
            var cek_time_in = time_in.substring(11, 13);
            var cek_time_out = time_out.substring(11, 13);

            //console.log(time_in.substring(11, 13));

            if (time_in === '') {

                alert('Mohon mengisikan jam masuk');

            } else if(time_out === '') {

                alert('Mohon mengisikan jam keluar');

            } else if(cek_time_out <= cek_time_in) {

                //alert('Jam keluar tidak boleh sebelum dibawah jam masuk');

                $('#time_out').after('<span class="error red-text">Jam keluar tidak boleh sebelum dibawah jam masuk</span>');

            } else{

               $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('addparkir') }}",
                dataType: 'json',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    time_in: time_in,
                    time_out: time_out
                },
                success: function(response) {
                    $('#modal3').modal('close'),
                        alert(response['message']),
                        window.location.reload();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    // console.log(xhr.status);
                    // console.log(xhr.responseText);
                    // console.log(thrownError);
                    alert(
                        xhr.status + "\\" +
                        xhr.responseText + "\\" +
                        thrownError
                    );
                }
            })
        }
    })

        function frmDel() {
            $('#modal2').modal('open');
            $('#header-modal-2').html("Form Request Delete By User Inputs");
        }

        function tutup2() {
            $("#modal2").modal('close');
            $('#del-kdt-form').trigger("reset");
        }

        function kalkulasi(id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ url('base/parkirkalkulasi') }}" + '/' + id,
                dataType: 'json',
                type: "PUT",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    alert(response['message']);
                    window.location.reload();
                    window.location = "{{ route('kalkulasi_parkir') }}";
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    // console.log(xhr.status);
                    // console.log(xhr.responseText);
                    // console.log(thrownError);
                    alert(
                        xhr.status + "\\" +
                        xhr.responseText + "\\" +
                        thrownError
                    );
                }
            });
        }
    </script>
@endsection
