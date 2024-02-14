@extends('includes.base')
@section('title')Archivo {{ $data->id }} @endsection
@section('content')
@auth
    <div class="flex-col align-middle">
        {{-- <a href="{{ route('list_files') }}" class="bg-gray-600 text-white font-bold p-5 appearance-none border-2 border-gray-200 rounded text-center flex align-middle justify-center w-1/16"><span>View all files</span></a> --}}
        <iframe class="w-full aspect-video md:aspect-square" src="/assets/uploads/{{$data->name}}"></iframe>
        <form action="{{ route('update_file') }}" class="bg-white shadow-md w-1/4 mx-auto rounded px-8 pt-6 pb-8 mb-4" method="post" enctype="multipart/form-data">
            <p class="text-5xl">Cambiar archivo</p>
            @csrf
            <input type="hidden" name="file_id" value="{{ $data->id }}">
            <input type="file" name="file" hidden id="file">
            <label for="file" class="bg-green-700 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 block leading-tight focus:outline-none focus:bg-white focus:border-green-500 text-white">Elegir archivo</label>
            <input type="submit" class="shadow bg-green-800 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded block w-full" value="Subir">
        </form>
        <div class="my-5">
            <h3 class="text-3xl font-semibold">Historial</h3>
            @foreach ($history as $info)
                <div class="flex flex-row gap-2">
                    <p class="w-4/6 border">{{ $info->description }}</p>
                    <p class="w-2/6 border">{{ $info->fecha_mod }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endauth
@unless (Auth::check())
    <a href="/" class="text-white bg-green-700 p-3 rounded">Iniciar sesión</a>
@endunless
@endsection