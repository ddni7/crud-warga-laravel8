<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- css toastr -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .abc {
            overflow: hidden;
            border-radius: 5%;
            box-shadow: 12px 8px 2px 1px rgba(0, 0, 255, .2);
            filter: blur(10%);
            /* -webkit-filter: blur(1%); */
        }

        .abc {
            width: 80px;
            height: 80px;
            transition: scale 400ms;
        }

        .abc:hover {
            scale: 128%;
        }
    </style>

    <title>CRUD Laravel 8</title>
</head>

<body>
    <h1 class="text-center mb-4">Data warga</h1>


    <!-- table -->
    <div class="container">
        <a href="/tambahwarga" class="btn btn-info">Tambah +</a>
        
        <div class="row g-3 align-items-center mt-1">
            <div class="col-auto">
                <form action="/warga" method="GET">
                <input type="search" name="search" class="form-control">
                </form>
            </div>
        </div>


        <div class="row">
            {{-- @if($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
            @endif --}}
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">Agama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">No Telephone</th>
                        <th scope="col">Di buat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $no = 1;
                    @endphp

                    @foreach($data as $index=> $row)
                    <tr>
                        <th scope="row">{{ $index + $data->firstItem() }}</th>

                        <td>{{ $row->nama }}</td>
                        <td>
                            <img src="{{ asset('fotowarga/'.$row->foto) }}" alt="" class="abc">
                        </td>
                        <td>{{ $row->jeniskelamin }}</td>
                        <td>{{ $row->agama }}</td>
                        <td>{{ $row->alamat }}</td>
                        <td>0{{ $row->notel }}</td>
                        <td>{{ $row->created_at->format('D M Y') }}</td>
                        <!-- <td>{{ $row->created_at->diffForHumans() }}</td> -->
                        <td>
                            <a href="/tampildata/{{ $row->id }}" class="btn btn-warning">Edit</a>
                            <a href="#" class="btn btn-danger delete" data-id="{{ $row->id }}" data-nama="{{ $row->nama }}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $data->links() }}
        </div>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <!-- script sweat -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- jquery cdn -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <!-- cdn toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

<script>
    $('.delete').click(function() {
        var wargaid = $(this).attr('data-id');
        var nama = $(this).attr('data-nama');
        swal({
                title: "Anda yakin?",
                text: "Anda akan menghapus data ini (" + nama + ") ",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/delete/" + wargaid + ""
                    swal("Data berhasil dihapus", {
                        icon: "success",
                    });
                } else {
                    swal("Data tidak jadi dihapus");
                }
            });
    });
</script>

<script>
    @if(Session::has('success'))

    toastr.success("{{ Session::get('success') }}")

    @endif
</script>

</html>