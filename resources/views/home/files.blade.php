@extends('includes.base')
@section('content')
    @auth
    <div class="w-full my-5 flex justify-center">
        <form action="{{ route('upload_file') }}" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post" enctype="multipart/form-data">
            <p class="text-5xl font-bold">Subir archivo</p>
            @csrf
            {{-- <input type="text" name="name" placeholder="Product Name" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 my-2 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"> --}}
            {{-- <input type="text" name="description" placeholder="Product description" class="bg-gray-200 my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500"> --}}
            <input type="file" name="file" hidden id="file">
            <label for="file" class="my-2 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 leading-tight focus:outline-none bg-lime-600 hover:cursor-pointer block text-white font-bold text-center">Elegir archivo</label>
            <input type="submit" class="shadow bg-green-900 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded w-full block" value="Subir archivo">
        </form>
    </div>
    @endauth
@endsection