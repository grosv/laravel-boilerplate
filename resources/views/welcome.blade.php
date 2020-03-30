@extends('layouts.app')

@section('content')

    <div class="bg-gray-50" x-data="{ openPanel: 1 }">
        <div class="max-w-screen-xl mx-auto py-12 px-4 sm:py-16 sm:px-6 lg:px-8">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-center text-3xl leading-9 font-extrabold text-gray-900 sm:text-4xl sm:leading-10">
                    Using This Boilerplate
                </h2>
                <div class="mt-6 border-t-2 border-gray-200 pt-6">
                    <dl>
                        @foreach ($questions as $question)
                            <div @if ($loop->iteration != 1)  class="mt-6 border-t border-gray-200 pt-6" @endif>
                                <dt class="text-lg leading-7">
                                    <button
                                        @click="openPanel = (openPanel === {{ $loop->iteration }} ? null : {{ $loop->iteration }})"
                                        class="text-left w-full flex justify-between items-start text-gray-400 focus:outline-none focus:text-gray-900">
                <span class="font-medium text-gray-900">
                  {{ $question['q'] }}
                </span>
                                        <span class="ml-6 h-7 flex items-center">
                  <svg class="h-6 w-6 transform" :class="{ '-rotate-180': openPanel === {{$loop->iteration}} }"
                       stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                  </svg>
                </span>
                                    </button>
                                </dt>
                                <dd class="mt-2 pr-12" x-show="openPanel === {{$loop->iteration}}">
                                    <p class="text-base leading-6 text-gray-500">
                                        {{ $question['a'] }}
                                    </p>
                                </dd>
                            </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
@endsection
