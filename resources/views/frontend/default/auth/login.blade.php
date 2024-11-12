@extends('frontend::layouts.auth')

@section('title')
    {{ __('Login') }}
@endsection

@section('content')

<!-- Enhanced Investment Theme Login Section with Raining Money and Snow Effect -->
<section class="section-style site-auth" style="background: linear-gradient(135deg, #0f0c29, #302b63, #24243e); min-height: 100vh; display: flex; align-items: center; justify-content: center; overflow: hidden; position: relative;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-lg-6 col-md-10">
                <div class="auth-content p-5 rounded shadow-lg text-center animate__animated animate__fadeInUp" style="background: rgba(255, 255, 255, 0.95); border-radius: 20px; animation-duration: 1.2s; position: relative; z-index: 10;">
                    
                    <!-- Spinning Logo with Financial Icon -->
                    <div class="logo mb-4 animate__animated animate__pulse" style="animation-duration: 2s; animation-iteration-count: infinite;">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset(setting('site_logo','global')) }}" alt="Logo" class="spinning-logo" style="width: 80px; filter: drop-shadow(0 0 10px #FFD700);">
                        </a>
                    </div>

                    <!-- Title Section with Financial Theme -->
                    <div class="title mb-4">
                        <h2 class="fw-bold" style="color: #333; font-size: 1.8rem;">Welcome to Kryptexa</h2>
                        <p style="color: #777; font-size: 1rem;">Start growing your investment portfolio</p>
                    </div>

                    <!-- Recent Activity Section with Enhanced Style and Animations -->
                    <div class="recent-activity mb-4">
                        <h5 class="text-warning">💰 Recent Activity 💰</h5>
                        <div class="recent-investors mt-3">
                            <h6 class="text-muted">Recent Investors</h6>
                            <ul id="investors-list" class="list-unstyled text-start">
                                <!-- JavaScript will populate this list -->
                            </ul>
                        </div>
                    </div>

                    <!-- Login Form Section -->
                    <form method="POST" action="{{ route('login') }}" class="mt-4">
                        @csrf
                        <div class="single-field mb-4 position-relative">
                            <label for="email" class="form-label" style="color: #444;">Email or Username</label>
                            <input type="text" name="email" class="form-control p-3 shadow-sm" placeholder="Enter your email or username" required style="border-radius: 30px; background-color: #f0f3f8; padding-right: 50px;" onfocus="this.style.background='#fef3c7'" onblur="this.style.background='#f0f3f8'"/>
                            <i class="fas fa-wallet position-absolute icon-align" style="right: 15px; top: 50%; transform: translateY(-50%); color: #FFD700;"></i>
                        </div>
                        <div class="single-field mb-4 position-relative">
                            <label for="password" class="form-label" style="color: #444;">Password</label>
                            <input type="password" name="password" class="form-control p-3 shadow-sm" placeholder="Enter your password" required style="border-radius: 30px; background-color: #f0f3f8; padding-right: 50px;" onfocus="this.style.background='#fef3c7'" onblur="this.style.background='#f0f3f8'"/>
                            <i class="fas fa-lock position-absolute icon-align" style="right: 15px; top: 50%; transform: translateY(-50%); color: #FFD700;"></i>
                        </div>
                        <button type="submit" class="btn w-100 py-3 text-white shadow animate__animated animate__pulse animate__infinite" style="background: linear-gradient(135deg, #FFD700, #ff9505); border-radius: 30px; font-size: 1.1rem; font-weight: bold;">
                            <i class="fas fa-coins me-2"></i> Login
                        </button>
                    </form>

                    <!-- Sign-Up Section -->
                    <div class="text-center mt-4 animate__animated animate__fadeInUp" style="animation-delay: 0.8s;">
                        <p style="color: #777;">Don't have an account? <a href="{{ route('register') }}" class="fw-bold" style="color: #ff9505;">Sign up for free</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Raining Money Effect Positioned at the Bottom -->
    <div class="money-rain-overlay" style="position: absolute; bottom: 0; left: 0; width: 100%; height: 100px; pointer-events: none; z-index: 5;">
        <div class="falling-money">💵</div>
        <div class="falling-money">💶</div>
        <div class="falling-money">💰</div>
        <div class="falling-money">💵</div>
        <div class="falling-money">💶</div>
        <div class="falling-money">💰</div>
    </div>
</section>

<!-- Styles for Recent Activity Section and Raining Money -->
<style>
    .recent-activity {
        background: #1a1a2e;
        padding: 20px;
        border-radius: 10px;
        color: #FFD700;
        text-align: center;
        box-shadow: 0px 0px 15px rgba(255, 223, 0, 0.5);
    }
    .recent-activity h5 {
        color: #FFD700;
        font-weight: bold;
        text-shadow: 0px 0px 10px #ff9505;
    }
    .recent-activity h6 {
        color: #FFA500;
        font-size: 0.9rem;
        text-shadow: 0px 0px 5px #ffd700;
    }
    .recent-activity ul {
        padding-left: 0;
        list-style: none;
        color: #FFF;
    }
    .recent-activity li {
        font-size: 0.85rem;
        color: #FFF;
        animation: fadeIn 1s ease-in-out forwards;
        background: rgba(255, 255, 255, 0.1);
        margin-bottom: 10px;
        padding: 8px;
        border-radius: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: transform 0.3s;
    }
    .recent-activity li:hover {
        transform: scale(1.05);
        box-shadow: 0px 0px 10px rgba(255, 223, 0, 0.7);
    }
    .money-icon {
        margin-right: 8px;
        color: #FFD700;
        animation: bounce 1.5s infinite;
    }

    /* Raining Money Styles */
    .money-rain-overlay {
        overflow: hidden;
    }
    .falling-money {
        position: absolute;
        font-size: 1.5rem;
        color: #FFD700;
        opacity: 0.8;
        animation: money-fall 10s linear infinite;
    }
    .falling-money:nth-child(1) { left: 10%; animation-delay: 1s; }
    .falling-money:nth-child(2) { left: 30%; animation-delay: 3s; }
    .falling-money:nth-child(3) { left: 50%; animation-delay: 5s; }
    .falling-money:nth-child(4) { left: 70%; animation-delay: 7s; }
    .falling-money:nth-child(5) { left: 90%; animation-delay: 9s; }

    @keyframes money-fall {
        0% { transform: translateY(-100px); }
        100% { transform: translateY(100px); opacity: 0; }
    }
</style>

<!-- JavaScript to Generate Fake Data with Casino-Like Animation -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // List of random names (Albanian and American)
        const names = [
            "Arben Hoxha", "Iliriana Berisha", "Lirim Kelmendi", "Shqipe Leka",
            "John Smith", "Emily Brown", "Michael Johnson", "Jessica Wilson",
            "Endrit Shala", "Dafina Krasniqi", "Kevin Davis", "Samantha Green",
            "Flutra Peci", "Mark Johnson", "Oliver Müller", "Anita Berisha",
            "Enver Zeqiri", "Lisa Weber", "David Anderson", "Sophia König",
            "Bujar Krasniqi", "Lena Meyer", "Ryan Davis", "Valbona Hoxha",
            "Stefan Braun", "Rachel Wilson", "Fatos Gashi", "Marta Engel",
            "James White", "Melina Frank", "Gentiana Leka", "Ismet Aliu",
            "Daniel Schmidt", "Anna Richter", "Jack Clark", "Julia Wolf",
            "Laura Hill", "Patrick King", "Blerta Dervishi", "Erik Fischer",
            "Dardan Bytyqi", "Max Weber", "Adem Selmani", "Sarah Moore",
            "Lindita Krasniqi", "Lukas Beck", "Benjamin Johnson", "Emma Martin",
            "Ariola Rexhepi", "Christopher Klein", "Kristina Thaqi", "Nick Clark",
            "Fadil Hoxha", "Besa Limani", "Manuel Zimmermann", "Emma Beck",
            "Albert Hoffman", "Edona Hoti", "Arian Leka", "Leona Berisha",
            "Jonas Lehmann", "Marie Fischer", "Leon Schneider", "Hanna Hoffmann",
            "Jason Lewis", "Amy Rivera", "Genc Zeqiri", "Alketa Krasniqi",
            "Thomas Weber", "Christine Baumann", "Ralf Bauer", "Jana Müller",
            "Besim Aliu", "Arjeta Leka", "David Wagner", "Linda Koch",
            "Ben Keller", "Grace Lopez", "Fatos Ibrahimi", "Diona Peci",
            "Tobias Schneider", "Laura Keller", "Stefan Neumann", "Alexandra Graf",
            "Paul Harris", "Sarah Walker", "James Young", "Chloe Thompson",
            "Lirim Rexha", "Arben Zeqiri", "Agim Krasniqi", "Evelyn Brown",
            "Oliver Klein", "Emma Schwarz", "Sebastian Schulz", "Mia Weber",
            "Megan Collins", "Ella Fisher", "Lukas Huber", "Helena Mayer",
            "Besarta Shala", "Andi Selmani", "Blerim Bytyqi", "Julia Becker",
            "Thomas Schmidt", "Sophie Wagner", "Peter Kruger", "Sophia Bauer",
            "Brian Scott", "Rachel Phillips", "David Price", "Emily Cook",
            "Rita Daka", "Arsim Berisha", "Lule Hoti", "Matthias Lang",
            "Linda White", "Luke Miller", "Janina Schneider", "Sarah Koch",
            "Dardan Morina", "Edlira Krasniqi", "Artur Rexhepi", "Valbona Zeqiri",
            "Laura Wolf", "Frank Schulz", "Daniel Klein", "Lara Vogt",
            "Erblin Dervishi", "Alban Bytyqi", "Fatmira Hoxha", "Lorik Leka",
            "Frederick Bauer", "Anna Hermann", "Julian Becker", "Sven Walter",
            "Amanda Green", "Henry Moore", "Christina Davis", "Julia King",
            "Gentian Kelmendi", "Anisa Peci", "Arben Ibrahimi", "Diana Leka",
            "Tina Brown", "David Haas", "Lena Hoffmann", "Marie Schulze",
            "Ryan Lee", "Natalie Scott", "Kyle Mitchell", "Liam Johnson",
            "Driton Rexha", "Artan Morina", "Shpend Bytyqi", "Shpresa Zeqiri",
            "Jan Müller", "Tom Schmitt", "Hans König", "Anja Fischer",
            "Samantha Turner", "Evelyn Collins", "Lucas Evans", "Holly Adams",
            "Zamira Gashi", "Labinot Hoxha", "Altin Krasniqi", "Shpresa Selimi",
            "Marius Beck", "Sabine Frank", "Chris Keller", "Melanie Weber",
            "Paul Lopez", "Alyssa Rogers", "Sophia Rivera", "Alexander Ward",
            "Elira Hoxha", "Linda Berisha", "Kreshnik Islami", "Arta Zeqiri",
            "Simon Schulz", "Eva Walter", "Jan Schmidt", "Nicole Hoffmann",
            "Jennifer Perry", "Sophia Scott", "Joshua Wright", "Olivia Richardson",
            "Gentiana Leka", "Ilir Hoxha", "Besjana Peci", "Blerim Daka",
            "Andreas Klein", "Elisa Neumann", "Lukas Berger", "Mara Bauer",
            "Paul Brown", "Leona Gray", "Andrew Stewart", "Daniela Clark",
            "Fatime Krasniqi", "Flutura Islami", "Aferdita Zeqiri", "Shpend Selmani",
            "David Schulze", "Jonas Lang", "Elias Walter", "Lea Lehmann",
            "Thomas Young", "Stephanie Wilson", "Ethan Lopez", "Emma Russell",
            "Yllka Hoxha", "Krenar Daka", "Ermal Selimi", "Nora Krasniqi",
            "Florian Frank", "Anke Fischer", "Melina Beck", "Nico Schulz",
            "Christina Reed", "Austin Cook", "Brian Brown", "Bella Thompson",
            "Arta Hoxha", "Shkelzen Islami", "Valentina Leka", "Blerta Berisha",
            "Simon Kaiser", "Sophie Koch", "Timo Schmitz", "Jana Weber",
            "Jake Robinson", "Ella Taylor", "Adrian Evans", "Kate Morris",
            "Rina Krasniqi", "Labinot Bytyqi", "Besa Morina", "Fatmir Zeqiri",
            "Sandra Klein", "Moritz Walter", "Jan Lehmann", "Jessica Müller",
            "Tyler Carter", "Sarah Martinez", "Ashley White", "Daniel Reed",
            "Gent Bytyqi", "Blerina Krasniqi", "Besart Selimi", "Ariana Daka",
            "Lars Neumann", "Martin Weber", "Katrin Klein", "Hanna König",
            "Tom Hill", "Mary Davis", "Benjamin Scott", "Victoria Roberts",
            "Arbnor Daka", "Ariana Zeqiri", "Ismail Selimi", "Elira Hoti",
            "Fabian Fuchs", "Lara Braun", "David Koch", "Miriam Mayer",
            "George Lee", "Carla Wilson", "Tommy Collins", "Zoe Walker",
            "Elton Hoxha", "Shqipe Krasniqi", "Gresa Daka", "Ardit Bytyqi",
            "Alexander Berger", "Lisa Schmitz", "Tim Schulze", "Sandra Meyer",
            "Linda Allen", "Chloe Lewis", "Blake Martin", "Ella Carter"
        ];
        
        // Function to get a random investment amount
        function getRandomAmount() {
            return (Math.floor(Math.random() * 1000) + 100) + " USD";
        }

        // Function to get a random name
        function getRandomName() {
            return names[Math.floor(Math.random() * names.length)];
        }

        // Function to update the investors list with animations
        function updateInvestors() {
            const investorsList = document.getElementById("investors-list");
            investorsList.innerHTML = ""; // Clear current list
            
            for (let i = 0; i < 3; i++) {
                const listItem = document.createElement("li");
                listItem.innerHTML = `<span><i class="fas fa-money-bill-wave money-icon"></i>${getRandomName()}</span><span>${getRandomAmount()}</span>`;
                investorsList.appendChild(listItem);
            }
        }

        // Update the list every 5 seconds
        updateInvestors();
        setInterval(updateInvestors, 4000);
    });
</script>

<!-- Font Awesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection

@section('script')
    @if($googleReCaptcha)
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @endif
@endsection
