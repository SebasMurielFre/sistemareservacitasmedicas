<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIS Medical - Centro Médico</title>
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{url('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{url('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 100px 0;
        }
        
        .service-card {
            transition: transform 0.3s ease;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .service-card:hover {
            transform: translateY(-5px);
        }
        
        .section-title {
            position: relative;
            margin-bottom: 50px;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: #667eea;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 500;
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        
        .contact-info {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
        }
        
        .footer {
            background: #2c3e50;
            color: white;
            padding: 40px 0;
        }

        .alert-custom {
            border-radius: 10px;
            border: none;
            padding: 20px;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand text-primary" href="#inicio">
                <i class="fas fa-heartbeat me-2"></i>SIS Medical
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#inicio">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#quienes-somos">Quiénes Somos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#servicios">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#agendar">Agendar Cita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacto">Contacto</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary-custom text-white ms-2" href="{{url('login')}}" target="_blank">
                            <i class="fas fa-sign-in-alt me-1"></i>Iniciar Sesión
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="inicio" class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold mb-4">Bienvenido a SIS Medical</h1>
                    <p class="lead mb-4">Tu salud es nuestra prioridad. Ofrecemos atención médica de calidad con profesionales especializados y tecnología de vanguardia.</p>
                    <div class="d-flex gap-3">
                        <a href="{{url('/admin')}}" class="btn btn-light btn-lg">
                            <i class="fas fa-calendar-plus me-2"></i>Agendar Cita
                        </a>
                        <a href="#servicios" class="btn btn-outline-light btn-lg">
                            <i class="fas fa-info-circle me-2"></i>Conocer Más
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="" alt="Centro Médico" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Quiénes Somos -->
    <section id="quienes-somos" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-title">Quiénes Somos</h2>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="" alt="Nuestro equipo" class="img-fluid rounded shadow">
                </div>
                <div class="col-lg-6">
                    <h3 class="mb-4">Comprometidos con tu Bienestar</h3>
                    <p class="mb-4">SIS Medical es un centro médico de excelencia que brinda atención integral de salud desde hace más de 15 años. Contamos con un equipo de profesionales altamente calificados y equipos de última generación.</p>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-check-circle text-success me-3 fs-4"></i>
                                <div>
                                    <h6 class="mb-1">Profesionales Certificados</h6>
                                    <small class="text-muted">Médicos especialistas</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-award text-warning me-3 fs-4"></i>
                                <div>
                                    <h6 class="mb-1">15+ Años de Experiencia</h6>
                                    <small class="text-muted">Sirviendo a la comunidad</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-microscope text-info me-3 fs-4"></i>
                                <div>
                                    <h6 class="mb-1">Tecnología Avanzada</h6>
                                    <small class="text-muted">Equipos de última generación</small>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-heart text-danger me-3 fs-4"></i>
                                <div>
                                    <h6 class="mb-1">Atención Personalizada</h6>
                                    <small class="text-muted">Cuidado integral</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Servicios -->
    <section id="servicios" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-title">Nuestros Servicios</h2>
                    <p class="lead mb-5">Ofrecemos una amplia gama de servicios médicos especializados</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card service-card h-100">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-stethoscope text-primary fs-1 mb-3"></i>
                            <h5 class="card-title">Medicina General</h5>
                            <p class="card-text">Consultas médicas generales, chequeos preventivos y seguimiento de tratamientos.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card service-card h-100">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-heart text-danger fs-1 mb-3"></i>
                            <h5 class="card-title">Cardiología</h5>
                            <p class="card-text">Diagnóstico y tratamiento de enfermedades cardiovasculares con tecnología avanzada.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card service-card h-100">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-x-ray text-info fs-1 mb-3"></i>
                            <h5 class="card-title">Radiología</h5>
                            <p class="card-text">Estudios de imagen digital, rayos X, ecografías y tomografías.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card service-card h-100">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-vial text-success fs-1 mb-3"></i>
                            <h5 class="card-title">Laboratorio</h5>
                            <p class="card-text">Análisis clínicos completos con resultados rápidos y precisos.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card service-card h-100">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-baby text-warning fs-1 mb-3"></i>
                            <h5 class="card-title">Pediatría</h5>
                            <p class="card-text">Atención médica especializada para bebés, niños y adolescentes.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card service-card h-100">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-user-md text-secondary fs-1 mb-3"></i>
                            <h5 class="card-title">Especialidades</h5>
                            <p class="card-text">Dermatología, ginecología, traumatología y otras especialidades médicas.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Horario -->
    <section id="horario" class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-title">Horario de Atención</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-inline float-right">
                                        <div class="input-group">
                                            <select name="doctor_id" id="doctor_id" class="form-control">
                                                <option value="">Seleccione un doctor</option>
                                                @foreach($horarios->pluck('doctor')->unique() as $doctor)
                                                    <option value="{{ $doctor->id }}" {{ request('doctor_id') == $doctor->id ? 'selected' : '' }}>
                                                        {{ $doctor->nombres }} {{ $doctor->apellidos }} - {{ $doctor->especialidad }} 
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-append">
                                                <a href="#" class="btn btn-secondary" id="limpiar-filtro" style="display:none; margin-left: 15px;">Limpiar filtro</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="tabla-horario-doctor-container">
                                @include('tabla_horario_doctor', ['horarios' => $horarios, 'doctor_id' => request('doctor_id')])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contacto -->
    <section id="contacto" class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-title">Contacto</h2>
                    <p class="lead mb-5">Estamos aquí para atenderte</p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="contact-info text-center h-100">
                        <i class="fas fa-map-marker-alt text-primary fs-1 mb-3"></i>
                        <h5>Dirección</h5>
                        <p class="mb-0">Av. Principal #123<br>Ciudad, Estado<br>Código Postal</p>
                    </div>
                </div>
                
                <div class="col-lg-4 mb-4">
                    <div class="contact-info text-center h-100">
                        <i class="fas fa-phone text-primary fs-1 mb-3"></i>
                        <h5>Teléfono</h5>
                        <p class="mb-0">
                            <strong>Principal:</strong> (555) 123-4567<br>
                            <strong>Emergencias:</strong> (555) 987-6543<br>
                            <strong>WhatsApp:</strong> (555) 111-2222
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-4 mb-4">
                    <div class="contact-info text-center h-100">
                        <i class="fas fa-clock text-primary fs-1 mb-3"></i>
                        <h5>Horarios</h5>
                        <p class="mb-0">
                            <strong>Lun - Vie:</strong> 8:00 AM - 6:00 PM<br>
                            <strong>Sábados:</strong> 8:00 AM - 2:00 PM<br>
                            <strong>Domingos:</strong> Emergencias
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <h5 class="mb-3">
                        <i class="fas fa-heartbeat me-2"></i>SIS Medical
                    </h5>
                    <p>Centro médico comprometido con brindar atención de calidad y calidez humana a todos nuestros pacientes.</p>
                    <div class="d-flex gap-3">
                        <a href="#" class="text-white"><i class="fab fa-facebook fs-4"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-instagram fs-4"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter fs-4"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-linkedin fs-4"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 mb-4">
                    <h6 class="mb-3">Enlaces</h6>
                    <ul class="list-unstyled">
                        <li><a href="#inicio" class="text-white-50">Inicio</a></li>
                        <li><a href="#quienes-somos" class="text-white-50">Quiénes Somos</a></li>
                        <li><a href="#servicios" class="text-white-50">Servicios</a></li>
                        <li><a href="#contacto" class="text-white-50">Contacto</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 mb-4">
                    <h6 class="mb-3">Servicios</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50">Medicina General</a></li>
                        <li><a href="#" class="text-white-50">Cardiología</a></li>
                        <li><a href="#" class="text-white-50">Pediatría</a></li>
                        <li><a href="#" class="text-white-50">Laboratorio</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 mb-4">
                    <h6 class="mb-3">Contacto Rápido</h6>
                    <p class="text-white-50 mb-1">
                        <i class="fas fa-envelope me-2"></i>info@sismedical.com
                    </p>
                    <p class="text-white-50 mb-1">
                        <i class="fas fa-phone me-2"></i>(555) 123-4567
                    </p>
                    <p class="text-white-50">
                        <i class="fas fa-map-marker-alt me-2"></i>Av. Principal #123
                    </p>
                </div>
            </div>
            
            <hr class="my-4">
            
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="mb-0 text-white-50">&copy; {{ date('Y') }} SIS Medical. Todos los derechos reservados.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-white-50 me-3">Política de Privacidad</a>
                    <a href="#" class="text-white-50">Términos de Servicio</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="{{url('plugins/jquery/jquery.min.js')}}"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables y extensiones -->
    <script src="{{url('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>

    <script>
        $(document).ready(function() {
            // Función para inicializar/reinicializar DataTables
            function initializeDataTable() {
                if ($.fn.DataTable.isDataTable('#example2')) {
                    $('#example2').DataTable().destroy();
                }
                
                var table = $("#example2").DataTable({
                    "pageLength": 24,
                    "dom": 'rtip',
                    "language": {
                        "emptyTable": "Seleccione un doctor para ver su horario"
                    },
                    "responsive": true,
                    "autoWidth": false,
                    "searching": false,
                    "lengthChange": false,
                    "info": false,
                    "paging": false,
                });
            }

            // Función para cargar la tabla de horarios
            function cargarTablaHorarioDoctor(doctorId) {
                $.ajax({
                    url: '{{ route('tabla_horario_doctor') }}',
                    type: 'GET',
                    data: { doctor_id: doctorId },
                    success: function(data) {
                        $('#tabla-horario-doctor-container').html(data);
                        initializeDataTable(); // Inicializar DataTables después de cargar
                    },
                    error: function(xhr) {
                        console.error('Error al cargar horarios:', xhr.responseText);
                    }
                });
            }

            // Eventos
            $('#doctor_id').on('change', function() {
                var doctorId = $(this).val();
                cargarTablaHorarioDoctor(doctorId);
                $('#limpiar-filtro').toggle(!!doctorId);
            });

            $('#limpiar-filtro').on('click', function(e) {
                e.preventDefault();
                $('#doctor_id').val('').trigger('change');
            });

            // Inicialización inicial
            if($('#doctor_id').val()) {
                $('#limpiar-filtro').show();
                cargarTablaHorarioDoctor($('#doctor_id').val());
            }

            // Smooth scrolling con jQuery para consistencia
            $('a[href^="#"]').on('click', function(e) {
                e.preventDefault();
                $('html, body').animate({
                    scrollTop: $($(this).attr('href')).offset().top
                }, 500);
            });

            // Set minimum date for appointment booking
            const fechaInput = document.getElementById('fecha');
            if (fechaInput) {
                const today = new Date();
                const tomorrow = new Date(today);
                tomorrow.setDate(tomorrow.getDate() + 1);
                fechaInput.min = tomorrow.toISOString().split('T')[0];
            }
        });
    </script>
</body>
</html>