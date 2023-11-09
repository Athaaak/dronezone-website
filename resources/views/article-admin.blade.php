@include('template.template')

@section('title')
Articles Admin
@endsection

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/richtexteditor/rte_theme_default.css" />
    <script type="text/javascript" src="/richtexteditor/rte.js"></script>
    <script type="text/javascript" src='/richtexteditor/plugins/all_plugins.js'></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/article-admin.css') }}">
</head>

<body>
    <div class="container-lg">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h2>Manage <b>Articles</b></h2>
                        </div>
                        <div class="col-sm-4">
                            <button type="button" class="btn btn-info add-new" data-toggle="modal"
                                data-target="#exampleModalCenter"><i class="fa fa-plus"></i> Add
                                New</button>
                        </div>

                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Add Articles</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>



                                    <form method="POST" enctype="multipart/form-data" name="article-form"
                                        id="article-form">

                                        @csrf

                                        <div class="modal-body">
                                            <div class="mb-3 form-group">
                                                <label class="form-label" for="customFile">Add Photos</label>
                                                <input type="file" class="form-control" name="image" id="image" />
                                                @error('image')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3 form-group">
                                                <label for="exampleInputPassword1" class="form-label">Article
                                                    Title</label>
                                                <input type="text" class="form-control" name="title" id="title"
                                                    placeholder="Masukkan Judul Artikel">
                                                @error('title')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="mb-3 form-group">
                                                <label class="form-label">Add
                                                    Content</label>
                                                <textarea class="form-control" rows="5" id="description"
                                                    name="description"></textarea>
                                                @error('description')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="reset" class="btn btn-warning">Reset</button>
                                            <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                                            <script>
                                                if ($("#article-form").length > 0) {
                                                    $("#article-form").validate({
                                                        rules: {
                                                            image: {
                                                                required: true,
                                                            },
                                                            title: {
                                                                required: true,
                                                            },
                                                            description: {
                                                                required: true,
                                                            },
                                                        },
                                                        messages: {
                                                            image: {
                                                                required: "Foto wajib ada",
                                                            },
                                                            title: {
                                                                required: "Judul wajib diisi",
                                                            },
                                                            description: {
                                                                required: "Konten wajib diisi",
                                                            },
                                                        },
                                                        submitHandler: function (form) {
                                                            $.ajaxSetup({
                                                                headers: {
                                                                    'X-CSRF-TOKEN': $(
                                                                        'meta[name="csrf-token"]'
                                                                    ).attr('content')
                                                                }
                                                            });
                                                            $.ajax({

                                                                url: "/article-admin",
                                                                type: "POST",
                                                                data: {
                                                                    'image': image,
                                                                    'title': title,
                                                                    'description': description,
                                                                },
                                                                error: function (xhr, status,
                                                                    error) {
                                                                    alert(xhr.responseText);
                                                                },
                                                                success: function (response) {
                                                                    $('#modalstatus').modal(
                                                                        "show");
                                                                    document.getElementById(
                                                                            "article-form")
                                                                        .reset();
                                                                }
                                                            });
                                                        }
                                                    })
                                                }

                                            </script>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if($message = Session::get('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @elseif($message = Session::get('delete'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{{ $message }}</strong>
                    </div>
                @endif
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($article as $article)
                            <tr>
                                <td class="text-center">
                                    <img src="{{ asset($article->image) }}" class="rounded" style="width: 150px">
                                </td>
                                <td>{{ $article->title }}</td>
                                <td>{{ $article->description }}</td>
                                <td class="text-center">
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                                        action="{{ route('article-admin.destroy', [$article->id]) }}"
                                        method="POST">
                                        <!-- <a href="{{ route('article.edit', $article->id) }}"
                                                class="btn btn-sm btn-primary">EDIT</a> -->
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Article belum Tersedia.
                            </div>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
