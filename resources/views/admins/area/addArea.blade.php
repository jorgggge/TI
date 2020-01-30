@extends('layouts.app')

@section('content')


<main class="py-4 py-5-mod">

    <div class="container contain">

        <div class=" justify-content-center">
            <section class="addArea">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Agregar Área</div>
                        <div class="card-body card-pad">
                            <form method="POST" action="/createArea/admins">
                                @csrf
                                <table class="" id="tAdmin">

                                    <tr>
                                        <th id="name">Nombre de Área</th>
                                        <td> <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" required autocomplete="name" autofocus>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </td>
                                    </tr>


                                </table>
                                <div class="addButt">
                                    <button type="submit" class="btn btn-add btn-primary">Agregar</button>
                                </div>


                            </form>
                        </div>

                    </div>
                </div>




            </section>
        </div>
    </div>
    </div>

</main>
</section>
@endsection
