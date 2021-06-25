@extends('layouts/contentLayoutMaster')

@section('title', 'Contact List')

@section('vendor-style')
  <!-- vendor css files -->
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

@endsection

@section('content')

  <!-- Basic Add ContactForm section start -->
  <section id="multiple-column-form">
    <div class="row">


      <div class="col-md-12 col-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Make a Call Indvidual Phone</h4>
          </div>
          <div class="card-body">

            <div class="max-w-lg rounded-lg shadow-lg p-5">
              <div class="text-4xl text-center tracking-wider text-gray-600 py-10">
                {{'22423423 '}}
              </div>
              <div class="grid grid-cols-3 gap-4">
                <button wire:click="addNumber('1')" class="bg-gray-300 text-2xl px-10 py-3 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-700">1</button>
                <button wire:click="addNumber('2')" class="bg-gray-300 text-2xl px-10 py-3 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-700">2</button>
                <button wire:click="addNumber('3')" class="bg-gray-300 text-2xl px-10 py-3 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-700">3</button>
                <button wire:click="addNumber('4')" class="bg-gray-300 text-2xl px-10 py-3 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-700">4</button>
                <button wire:click="addNumber('5')" class="bg-gray-300 text-2xl px-10 py-3 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-700">5</button>
                <button wire:click="addNumber('6')" class="bg-gray-300 text-2xl px-10 py-3 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-700">6</button>
                <button wire:click="addNumber('7')" class="bg-gray-300 text-2xl px-10 py-3 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-700">7</button>
                <button wire:click="addNumber('8')" class="bg-gray-300 text-2xl px-10 py-3 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-700">8</button>
                <button wire:click="addNumber('9')" class="bg-gray-300 text-2xl px-10 py-3 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-700">9</button>
                <button wire:click="addNumber('0')" class="col-span-3 bg-gray-300 text-2xl px-10 py-3 rounded-lg hover:bg-gray-700 hover:text-white transition-all duration-700">0</button>
              </div>
              <div class="mt-4">
                <button onclick="callCustomer('+923007272332')" class="w-full bg-green-500 py-3 text-white text-2xl uppercase font-black rounded-lg hover:bg-green-600 transition-all duration-700">Call</button>
              </div>
            </div>


          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Basic Floating Label Form section end -->
@endsection
@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/call/browser_call.js')) }}"></script>
@endsection