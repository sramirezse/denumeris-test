<div class="bg-real">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form class="p-5" method="POST" action="{{ route('register') }}">

        @csrf
        <div class="mb-3">
            <label for="inputplates" class="form-label">Placas de tu auto</label>
            <input type="text" name="plate" class="form-control" id="inputplates" aria-describedby="platesHelp" placeholder="Placas de tu vehículo">
            <div id="platesHelp" class="form-text" style="color:#fff !important">Las placas serán tu usuario.</div>
        </div>

        <div class="mb-3">
            <label for="dropdown-input-trademark" class="form-label">Marca de tu vehículo</label>
            {{-- <input type="text" name="trademark" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"> --}}
            <input id="dropdown-input-trademark" name="trademark" class="Search-Select--Hidden-Input"
                placeholder="Elige la marca..." data-search-placeholder="Buscar" hidden />
        </div>

        <div class="mb-3">
            <label for="dropdown-input-model" class="form-label">Modelo de tu vehículo</label>
            {{-- <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"> --}}
            <input id="dropdown-input-model" name="model" class="Search-Select--Hidden-Input"
                placeholder="Elige el modelo..." data-search-placeholder="Buscar" hidden />
        </div>

        <div class="mb-3">
            <label for="inputYear" class="form-label">Año de tu vehículo</label>
            <input type="number" autoComplete="false" name="year" class="form-control" id="inputYear"
                aria-describedby="yearHelp" placeholder="Año de tu vehículo">
        </div>

        <div class="mb-3">
            <label for="inputColor" class="form-label">Color</label>
            <input type="text" autoComplete="false" name="color" class="form-control" id="inputColor"
                aria-describedby="colorHelp" placeholder="Color del vehículo">
        </div>

        <div class="mb-3">
            <label for="InputPassword1" class="form-label">Contraseña</label>
            <input type="password" autoComplete="false" class="form-control" name="password" id="InputPassword1" placeholder="Escribe una contraseña">
        </div>

        <button type="submit" class="btn btn-primary btn-submit">Enviar</button>
    </form>
</div>
<div class="bg-test">
</div>
<style>
     .form-label{
    display: none !important;
    }
    .bg-test {
        /*background-color: rgba(38, 75, 167, 0.67);*/
        height: auto;
        width: 30vw;
        /*position: absolute;*/
        top: 0;
        /*left: 0;*/
        right: 0;
        bottom: 0;
        margin: auto;
        margin-top: 40px;
        filter: blur(200px);
        z-index: 1;

    }

    .bg-real {
        background-color: rgba(120, 120, 120, 0.641);
        max-height: auto;
        height: auto;
        border-radius: 16px !important;
        width: 30vw;
        margin: auto;
        margin-top: 40px;
        z-index: 2;
        /*position: absolute;*/
        top: 0;
        /*left: 0;*/
        right: 0;
        bottom: 0;
         color: aliceblue
    }
    .btn-submit{
        width: 100%;
    }


    @media (max-width: 900px) {
        .bg-test {
            display: none;
            width: 85vw !important;
             top:0;
            left:0;
            right:0;
            bottom:0;

        }

        .bg-real {
            top:0;
            left:0;
            right:0;
            bottom:0;
            margin: none;
            width: 85vw !important;

        }
    }
</style>
{{-- @push('scripts')
    <script>
        const selectElement = document.getElementById('dropdown-input-trademark');

        selectElement.addEventListener('change', (event) => {
            const resultado = event;
            console.log('resultado', resultado);
        });

        let modelValue = '';
        let trademarkValue = '';
        const models = @json($models);
        const marcas = @json($trademarks);
        // console.log(models);
        const searchSelectDropdownTrademark = new SearchSelect('#dropdown-input-trademark', {

            data: marcas,
            filter: SearchSelect.FILTER_CONTAINS,
            sort: undefined,
            inputClass: 'form-control mobile-field',
            maxOpenEntries: 9,
            searchPosition: 'top',
            onInputClickCallback: function(ev) {
                console.log('Input Clicked', ev)

            },
            onInputKeyDownCallback: function(ev) {
                console.log('Input Key Down')
            },
            // document.getElementById('dropdown-input-model').addEventListner('change', function(ev) { console.log('Value changed'); })
        });
        const searchSelectDropdownModel = new SearchSelect('#dropdown-input-model', {
            data: models,
            filter: SearchSelect.FILTER_CONTAINS,
            sort: undefined,
            inputClass: 'form-control mobile-field',
            maxOpenEntries: 9,
            searchPosition: 'top',
            onInputClickCallback: function(ev) {
                console.log('Input Clicked')
            },
            onInputKeyDownCallback: function(ev) {
                console.log('Input Key Down')
            },
        });
    </script>
@endpush --}}
