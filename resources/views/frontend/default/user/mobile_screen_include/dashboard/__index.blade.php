<div id="a2hs-popup" style="display: none; position: fixed; bottom: 20px; right: 20px; background: #fff; padding: 15px; border-radius: 10px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3); z-index: 1000;">
    <p style="margin: 0; font-weight: bold;">Add this app to your home screen for a better experience!</p>
    <button onclick="installApp()" style="margin-top: 10px; padding: 8px 12px; background-color: #28a745; color: #fff; border: none; border-radius: 5px; cursor: pointer;">Add to Home Screen</button>
    <button onclick="closeA2HSPopup()" style="margin-top: 10px; margin-left: 10px; padding: 8px 12px; background-color: #dc3545; color: #fff; border: none; border-radius: 5px; cursor: pointer;">Close</button>
</div>
<div class="row">
    <div class="col-12">
        <div class="user-ranking-mobile">
            <div class="icon">
                <img src="{{ asset($user->avatar ?? 'global/materials/user.png') }}" alt=""/>
            </div>
            <div class="name">
                <h4>{{ __('Hi') }}, {{ $user->full_name }}</h4>
                <p>{{ $user->rank->ranking_name }} - <span>{{ $user->rank->ranking }}</span></p>
            </div>
            <div class="rank-badge">
                <img src="{{ asset( $user->rank->icon) }}" alt=""/>
            </div>
        </div>
        <div class="user-wallets-mobile">
            <img src="{{ asset('frontend/materials/wallet-shadow.png') }}" alt="" class="wallet-shadow">
            <div class="head">{{ __('All Wallets in') }} {{ $currency }}</div>
            <div class="one">
                <div class="balance">
                    <span class="symbol">{{ $currencySymbol }}</span>{{ Str::before($user->balance, '.') }}
                    <span class="after-dot">.{{ strpos($user->balance, '.') ? Str::after($user->balance, '.') : '00' }} </span>
                </div>
                <div class="wallet">{{ __('Main Wallet') }}</div>
            </div>
            <div class="one p-wal">
                <div class="balance">
                    <span class="symbol">{{ $currencySymbol }}</span>{{ $user->profit_balance }}
                    <span class="after-dot">.{{ strpos($user->profit_balance, '.') ? Str::after($user->profit_balance, '.') : '00' }} </span>
                </div>
                <div class="wallet">{{ __('Profit Wallet') }}</div>
            </div>
            <div class="info">
                <i icon-name="info"></i>{{ __('You Earned') }} {{ $dataCount['profit_last_7_days'] }} {{ $currency }} {{ __('This Week') }}
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="mob-shortcut-btn">
            <a href="{{ route('user.deposit.amount') }}"><i class="fas fa-wallet"></i> {{ __('Deposit') }}</a>
            <a href="{{ route('user.schema') }}"><i class="fas fa-chart-line"></i> {{ __('Investment Plans') }}</a>
            <a href="{{ route('user.withdraw.view') }}"><i class="fas fa-hand-holding-usd"></i> {{ __('Withdraw') }}</a>
        </div>
    </div>

    <div class="col-12">
        <!-- all navigation -->
        @include('frontend::user.mobile_screen_include.dashboard.__navigations')

        <!-- Recent Activity Section -->
        <div class="recent-activity mt-4">
            <h5 class="text-warning"><i class="fas fa-coins"></i> Recent Activity</h5>
            <div class="recent-investors mt-3">
                <h6 class="text-muted">Recent Investors</h6>
                <ul id="investors-list" class="list-unstyled text-start">
                    <!-- JavaScript will populate this list dynamically -->
                </ul>
            </div>
        </div>

        <!-- all Statistic -->
        @include('frontend::user.mobile_screen_include.dashboard.__statistic')
    </div>
<div class="col-12">
    <div class="mobile-ref-url mb-4 animate__animated animate__fadeInUp">
        <div class="all-feature-mobile">
            <div class="title-ref">{{ __('Referral URL') }}</div>
            <div class="mobile-referral-link-form">
                <input type="text" value="{{ $referral->link }}" id="refLink" class="referral-input glow-input" readonly/>
                <button type="button" onclick="copyRef()" class="copy-button" id="copyButton">
                    <span id="copy-text">{{ __('Copy') }}</span>
                </button>
            </div>
            <p class="referral-joined animate__animated animate__fadeIn">
                <i class="fas fa-users"></i> {{ $referral->relationships()->count() }} {{ __('people have joined using this URL') }}
            </p>
        </div>
    </div>
</div>

<style>
    /* Styling for the referral section */
    .mobile-ref-url {
        background: linear-gradient(135deg, #1e2a47, #16233c);
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .mobile-ref-url:hover {
        transform: translateY(-5px);
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.5);
    }

    .title-ref {
        font-size: 1.4rem;
        color: #f0f3f8;
        font-weight: bold;
        margin-bottom: 15px;
        text-align: center;
        text-shadow: 0px 0px 10px rgba(255, 255, 255, 0.3);
    }

    .referral-input {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 30px;
        background-color: #0d1930;
        color: #ffffff;
        font-size: 1rem;
        margin-right: 10px;
        outline: none;
        text-align: center;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .referral-input:focus {
        background-color: #192c49;
        box-shadow: 0px 0px 15px rgba(72, 167, 255, 0.5);
    }

    .glow-input {
        box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.2);
        animation: glow 2s ease-in-out infinite alternate;
    }

    .copy-button {
        background: linear-gradient(135deg, #ff4b5c, #ff6b6b);
        color: #ffffff;
        border: none;
        border-radius: 25px;
        padding: 12px 25px;
        font-size: 1rem;
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        outline: none;
        display: flex;
        align-items: center;
    }

    .copy-button:hover {
        transform: scale(1.05);
        box-shadow: 0px 0px 15px rgba(255, 75, 92, 0.8);
    }

    .copy-button:active {
        transform: scale(0.98);
    }

    .referral-joined {
        color: #d3d3d3;
        font-size: 0.85rem;
        margin-top: 15px;
        text-align: center;
        animation: fadeInUp 1s ease;
    }

    .referral-joined i {
        color: #ffd700;
        margin-right: 5px;
    }

    /* Glow animation */
    @keyframes glow {
        0% {
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.5), 0 0 20px rgba(72, 167, 255, 0.5);
        }
        100% {
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.8), 0 0 40px rgba(72, 167, 255, 0.7);
        }
    }
</style>

<script>
    function copyRef() {
        var copyText = document.getElementById("refLink");
        
        navigator.clipboard.writeText(copyText.value).then(function() {
            var copyBtn = document.getElementById("copy-text");
            copyBtn.innerText = "Copied!";
            copyBtn.parentNode.style.backgroundColor = "#28a745";  // Change button color to green

            setTimeout(function() {
                copyBtn.innerText = "Copy";
                copyBtn.parentNode.style.backgroundColor = "";  // Reset button color
            }, 1500); // Reset after 1.5 seconds
        }, function(err) {
            console.error("Unable to copy", err);
        });
    }
</script>

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
            "Flutra Peci", "Mark Johnson", "Oliver MÃ¼ller", "Anita Berisha",
            "Enver Zeqiri", "Lisa Weber", "David Anderson", "Sophia KÃ¶nig",
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
            "Thomas Weber", "Christine Baumann", "Ralf Bauer", "Jana MÃ¼ller",
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
            "Jan MÃ¼ller", "Tom Schmitt", "Hans KÃ¶nig", "Anja Fischer",
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
            "Sandra Klein", "Moritz Walter", "Jan Lehmann", "Jessica MÃ¼ller",
            "Tyler Carter", "Sarah Martinez", "Ashley White", "Daniel Reed",
            "Gent Bytyqi", "Blerina Krasniqi", "Besart Selimi", "Ariana Daka",
            "Lars Neumann", "Martin Weber", "Katrin Klein", "Hanna KÃ¶nig",
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
<script>
    let deferredPrompt;

    // Listen for the beforeinstallprompt event
    window.addEventListener('beforeinstallprompt', (e) => {
        // Prevent the mini-info bar from appearing
        e.preventDefault();
        // Save the event for triggering later
        deferredPrompt = e;
        // Display the "Add to Home Screen" popup
        document.getElementById('a2hs-popup').style.display = 'block';
    });

    // Function to trigger the install prompt
    function installApp() {
        // Hide the A2HS popup
        document.getElementById('a2hs-popup').style.display = 'none';
        // Show the install prompt
        deferredPrompt.prompt();
        // Wait for the user's response to the prompt
        deferredPrompt.userChoice.then((choiceResult) => {
            if (choiceResult.outcome === 'accepted') {
                console.log('User accepted the A2HS prompt');
            } else {
                console.log('User dismissed the A2HS prompt');
            }
            deferredPrompt = null;
        });
    }

    // Optional: function to close the popup
    function closeA2HSPopup() {
        document.getElementById('a2hs-popup').style.display = 'none';
    }
</script>

