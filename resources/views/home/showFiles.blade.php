@extends('includes.base')
@section('content')
    @auth
        <div class="flex justify-center flex-col p-10 w-full">
            <h1 class="text-6xl font-extrabold text-center">Archivos</h1>
            {{-- <table class="border-collapse border-2 border-gray-700">
                <thead>
                    <tr>
                        <th class="border-4 border-gray-900 p-3 text-gray-900">Name</th>
                        <th class="border-4 border-gray-900 p-3 text-gray-900">View</th>
                        <th class="border-4 border-gray-900 p-3 text-gray-900">Download</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $data)
                        <tr>
                            <td class="border-2 p-3 text-gray-900">{{$data->name}}</td>
                            <td class="border-2 p-3 w-fit text-white bg-gray-700 font-bold"><a href="{{route('view_file',$data->id)}}">View</a></td>
                            <td class="border-2 p-3 text-gray-900"><a href="{{url('/descargar',$data->name)}}">Download</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table> --}}
            <div class="grid grid-cols-4 gap-5">
                @foreach($data as $file)
                    <a href="{{ route('view_file', $file->id) }}" class="block border rounded-md p-3">
                        <p class="block text-center">
                            @switch($file->extension)
                                @case('jpg')
                                @case('jpeg')
                                @case('png')
                                    <i class="fa-solid fa-image text-blue-500 text-8xl"></i>
                                    @break
                                @case('docx')
                                @case('doc')
                                    <i class="fa-solid text-8xl text-blue-700 fa-file-word"></i>
                                    @break
                                @case('xlsx')
                                @case('xls')
                                    <i class="fa-solid text-8xl text-green-700 fa-file-excel"></i>
                                    @break
                                @case('pdf')
                                    <i class="fa-solid text-8xl text-red-600 fa-file-pdf"></i>
                                    @break
                                @case('pptx')
                                @case('ppt')
                                    <i class="fa-solid text-8xl text-red-400 fa-file-powerpoint"></i>
                                    @break
                                @default
                                    <i class="fa-solid text-8xl text-slate-800 fa-file"></i>
                            @endswitch
                        </p>
                        @php
                        $word = explode('.', $file->name);
                        @endphp
                        <p class="text-center">{{ array_shift($word) }}</p>
                    </a>
                @endforeach
            </div>
            {{-- <a href="{{ route("files") }}" class="inline-block font-semibold border border-collapse bg-green-800 text-white p-2 rounded text-sm w-32">Agregar archivo</a> --}}
        </div>
    @endauth
@endsection