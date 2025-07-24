@extends('layouts.app')

@section('content')

    <div class="w-[90%] mx-auto mb-8">
        <div  class="flex gap-5 mb-7">
            <div class="w-1/4 bg-[#667eea] py-3 text-white rounded-3xl flex justify-center flex-col items-center">
                <span class="font-bold text-[40px]">
                    {{ $totalUser }}
                </span>
                <span class="flex">
                    <img src="{{ asset('images/icons/user-1-svgrepo-com.svg') }}" alt="Icon" class="w-6 h-6 mr-1">
                    Total User
                </span>
            </div>
            <div class="w-1/4 bg-[#667eea] py-3 text-white rounded-3xl flex justify-center flex-col items-center">
                <span class="font-bold text-[40px]">
                    {{ $totalPost }}
                </span>
                <span class="flex">
                    <img src="{{ asset('images/icons/user-1-svgrepo-com.svg') }}" alt="Icon" class="w-6 h-6 mr-1">
                    Total Post
                </span>
            </div>
            <div class="w-1/4 bg-[#667eea] py-3 text-white rounded-3xl flex justify-center flex-col items-center">
                <span class="font-bold text-[40px]">
                    {{ $totalAuthor }}
                </span>
                <span class="flex">
                    <img src="{{ asset('images/icons/user-1-svgrepo-com.svg') }}" alt="Icon" class="w-6 h-6 mr-1">
                    Total Author
                </span>
            </div>
            <div class="w-1/4 bg-[#667eea] py-3 text-white rounded-3xl flex justify-center flex-col items-center">
                <span class="font-bold text-[40px]">
                    1234
                </span>
                <span class="flex">
                    <img src="{{ asset('images/icons/user-1-svgrepo-com.svg') }}" alt="Icon" class="w-6 h-6 mr-1">
                    Total Request
                </span>
            </div>
        </div>

        <div class="flex gap-10">

          <!-- Recent Post Section -->
          <div class="w-[65%] py-6 px-8 bg-white rounded-3xl shadow-md">
            <h3 class="text-2xl font-bold text-gray-800 mb-6">🕘 Recent Post</h3>

            <ul class="space-y-4">
              @foreach($latestPosts as $post)
                <li class="flex items-center gap-4">

                 
                  <div class="h-[50px] w-[105px] rounded-lg overflow-hidden flex-shrink-0 ">
                    <img 
                      src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : asset('images/thumbnail.png') }}" 
                      alt="{{ $post->title }}" 
                      class="w-full h-full object-cover"
                    >
                  </div>

                  <div class="flex-1">
                    <h4 class="text-sm font-semibold text-gray-800 truncate">{{ $post->title }}</h4>
                    <p class="text-xs text-gray-500 truncate">{{ Str::limit(strip_tags($post->description), 60) }}</p>
                    <span class="text-xs text-gray-400">{{ $post->created_at->diffForHumans() }}</span>
                  </div>

               
                  <a href="{{ route('posts.show', $post) }}" class="text-xs text-primary hover:underline">View</a>
                </li>
              @endforeach
            </ul>
          </div>

        <!-- Chart -->
          <div class="w-[35%]">
            <div class=" bg-gray-100 p-10 text-gray-800  rounded-3xl shadow-md ">
              <canvas id="doughnutChart" class="w-full max-w-[300px]"></canvas>
            </div>
          </div>
        </div>


        
    </div>
    
@endsection


@php
  $male = $genderValues[0];
  $female = $genderValues[1];
  $none = $genderValues[2];
  
@endphp

@section('scripting')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

  const barChart = document.getElementById('myChart').getContext('2d');
  new Chart(barChart, {
      type: 'bar',
      data: {
          labels: ['January', 'February', 'March', 'April'],
          datasets: [
              {
                  label: 'Dataset 1',
                  data: [10, 20, 15, 25],
                  backgroundColor: '#583AD6',
                  borderColor: 'rgba(75, 192, 192, 1)',
                  borderWidth: 1
              },
              {
                  label: 'Dataset 2',
                  data: [15, 10, 20, 30],
                  backgroundColor: 'rgba(153, 102, 255, 0.6)',
                  borderColor: 'rgba(153, 102, 255, 1)',
                  borderWidth: 1
              }
          ]
      },
      options: {
          responsive: true,
          scales: {
              y: {
                  beginAtZero: true
              }
          }
      }
  });

</script>

<script >
   const doughnutChart = document.getElementById('doughnutChart');
  //  var data = `@json($genderValues)`
  //  console.log(data)

  new Chart(doughnutChart, {
    type: 'doughnut',
    data: {
      labels: ['Male', 'Female', 'None'],
      datasets: [{
        label: 'Gender',
        data: [`{{ $male }}`, `{{ $female }}`, `{{ $none }}`],
        backgroundColor: [
          '#4F46E5', // Male - Indigo
          '#F472B6', // Female - Pink
          '#A3A3A3'  // None - Gray
        ],
        borderColor: [
          '#312E81', // Male border
          '#BE185D', // Female border
          '#525252'  // None border
        ],
        borderWidth: 2,
      }]
    },
    options: {
      responsive: true,
       cutout: '70%',
      plugins: {
        legend: {
          position: 'bottom'
        }
      },
      
    }
  });

</script>

@endsection