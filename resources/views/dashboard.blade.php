@extends('layouts.app')

@section('content')
<style>
    .chart-container {
        position: relative;
        height: 250px; /* أو أي ارتفاع تفضله */
        width: 100%;
    }
    
    canvas {
        width: 100% !important;
        height: 100% !important;
    }
</style>
    <div class="container">
        <div class="card p-4 shadow">
            <!-- Header Section -->
            <div class="text-center mb-4">
                <h2 class="fw-bold text-primary">Admin Dashboard</h2>
                <p class="text-muted">Overview of your platform's performance</p>
            </div>

            <!-- Summary Stats Cards -->
            <div class="row mb-4 g-4">
                <div class="col-md-3 col-6">
                    <div class="card text-white bg-primary h-100">
                        <div class="card-body text-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Total Posts</h5>
                                    <h3 class="mb-0">{{ $stats['total_posts'] }}</h3>
                                </div>
                                <i class="fas fa-newspaper fa-2x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="card text-white bg-success h-100">
                        <div class="card-body text-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Approved Posts</h5>
                                    <h3 class="mb-0">{{ $stats['approved_posts'] }}</h3>
                                </div>
                                <i class="fas fa-check-circle fa-2x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="card text-white bg-warning h-100">
                        <div class="card-body text-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Pending Posts</h5>
                                    <h3 class="mb-0">{{ $pendingPosts }}</h3>
                                </div>
                                <i class="fas fa-clock fa-2x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="card text-white bg-danger h-100">
                        <div class="card-body text-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Writer Requests</h5>
                                    <h3 class="mb-0">{{ $stats['writer_requests'] }}</h3>
                                </div>
                                <i class="fas fa-user-edit fa-2x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Second Row of Stats -->
            <div class="row mb-4 g-4">
                <div class="col-md-4 col-6">
                    <div class="card text-white bg-info h-100">
                        <div class="card-body text-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Total Comments</h5>
                                    <h3 class="mb-0">{{ $totalComments }}</h3>
                                </div>
                                <i class="fas fa-comments fa-2x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="card text-white bg-dark h-100">
                        <div class="card-body text-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Avg Likes/Post</h5>
                                    <h3 class="mb-0">{{ $stats['avg_likes_per_post'] }}</h3>
                                </div>
                                <i class="fas fa-thumbs-up fa-2x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-6">
                    <div class="card text-white bg-secondary h-100">
                        <div class="card-body text-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="card-title">Approval Rate</h5>
                                    <h3 class="mb-0">{{ $stats['approval_rate'] }}%</h3>
                                </div>
                                <i class="fas fa-chart-line fa-2x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="row mt-4 g-4">
                <!-- Monthly Posts -->
                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-header bg-white">
                            <h5 class="fw-bold mb-0">📅 Monthly Posts</h5>
                        </div>
                        <div class="chart-container">
                            <canvas id="monthlyPostsChart"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Top Categories -->
                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-header bg-white">
                            <h5 class="fw-bold mb-0">🏷️ Most Used Categories</h5>
                        </div>
                        <div class="chart-container">
                            <canvas id="topCategoriesChart" height="250"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Engagement Metrics -->
            <div class="row mt-4 g-4">
                <!-- Top Liked Posts -->
                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-header bg-white">
                            <h5 class="fw-bold mb-0">👍 Top Liked Posts</h5>
                        </div>
                        <div class="chart-container">
                            <canvas id="likesChart" height="250"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Top Commented Posts -->
                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-header bg-white">
                            <h5 class="fw-bold mb-0">💬 Top Commented Posts</h5>
                        </div>
                        <div class="chart-container">
                            <canvas id="commentsChart" height="250"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Writers Section -->
            <div class="row mt-4 g-4">
                <!-- Top Writers -->
                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-header bg-white">
                            <h5 class="fw-bold mb-0">🧑‍💻 Top Writers</h5>
                        </div>
                        <div class="chart-container">
                            <canvas id="topWritersChart" height="250"></canvas>
                        </div>
                    </div>
                </div>
                
                <!-- Active Writers by Interaction -->
                <div class="col-lg-6">
                    <div class="card h-100">
                        <div class="card-header bg-white">
                            <h5 class="fw-bold mb-0">🌟 Most Active Writers</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach ($mostActiveWritersByInteraction as $writer)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <span class="fw-bold">{{ $writer->user->name }}</span>
                                            <small class="text-muted d-block">{{ $writer->posts_count }} posts</small>
                                        </div>
                                        <span class="badge bg-primary rounded-pill">{{ $writer->total_likes }} likes</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Approval Time -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card text-center py-3 bg-light">
                        <div class="card-body">
                            <h4 class="fw-bold">⏱️ Average Approval Time</h4>
                            <div class="display-4 text-primary fw-bold">{{ round($averageApprovalTime, 2) }} Hours</div>
                            <p class="text-muted mt-2">Time between submission and approval</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script>
        // Chart configurations
        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                tooltip: {
                    enabled: true,
                    mode: 'index',
                    intersect: false,
                }
            }
        };

        // Monthly Posts Chart
        const monthlyCtx = document.getElementById('monthlyPostsChart').getContext('2d');
        new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode(
                    array_values(array_map(fn($m) => date('M', mktime(0, 0, 0, $m, 10)), array_keys($monthlyPosts->toArray()))),
                ) !!},
                datasets: [{
                    label: 'Posts Published',
                    data: {!! json_encode(array_values($monthlyPosts->toArray())) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                ...chartOptions,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        // Top Writers Chart
        const writersCtx = document.getElementById('topWritersChart').getContext('2d');
        new Chart(writersCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($topWriters->pluck('name')) !!},
                datasets: [{
                    label: 'Posts Count',
                    data: {!! json_encode($topWriters->pluck('posts_count')) !!},
                    backgroundColor: 'rgba(153, 102, 255, 0.6)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                ...chartOptions,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Top Categories Chart
        const categoriesCtx = document.getElementById('topCategoriesChart').getContext('2d');
        new Chart(categoriesCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($topCategories->pluck('name')) !!},
                datasets: [{
                    data: {!! json_encode($topCategories->pluck('posts_count')) !!},
                    backgroundColor: [
                        '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
                        '#FF9F40', '#8AC24A', '#607D8B', '#E91E63', '#9C27B0'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                ...chartOptions,
                cutout: '65%',
                plugins: {
                    legend: {
                        position: 'right'
                    }
                }
            }
        });

        // Top Liked Posts
        const likesCtx = document.getElementById('likesChart').getContext('2d');
        new Chart(likesCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($topLikedPosts->pluck('title')) !!},
                datasets: [{
                    label: 'Likes',
                    data: {!! json_encode($topLikedPosts->pluck('likes_count')) !!},
                    backgroundColor: [
                        '#36A2EB', '#4BC0C0', '#FF6384', '#FFCE56', '#9966FF'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                ...chartOptions,
                cutout: '65%'
            }
        });

        // Top Commented Posts
        const commentsCtx = document.getElementById('commentsChart').getContext('2d');
        new Chart(commentsCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($topCommentedPosts->pluck('title')) !!},
                datasets: [{
                    label: 'Comments',
                    data: {!! json_encode($topCommentedPosts->pluck('comments_count')) !!},
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                ...chartOptions,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
@endsection