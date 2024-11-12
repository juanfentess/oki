<div class="bottom-appbar" style="background-color: #4e54c8; padding: 10px; border-radius: 20px;">
    <a href="{{ route('user.dashboard') }}" class="{{ isActive('user.dashboard') }}">
        <i icon-name="home" class="menu-icon"></i>
    </a>
    <a href="{{ route('user.deposit.amount') }}" class="{{ isActive('user.deposit*') }}">
        <i icon-name="wallet" class="menu-icon"></i>
    </a>
    <a href="{{ route('user.schema') }}" class="{{ isActive('user.schema*') }}">
        <i icon-name="bar-chart" class="menu-icon"></i>
    </a>
    <a href="{{ route('user.referral') }}" class="{{ isActive('user.referral*') }}">
        <i icon-name="gift" class="menu-icon"></i>
    </a>
    <a href="{{ route('user.setting.show') }}" class="{{ isActive('user.setting*') }}">
        <i icon-name="settings" class="menu-icon" style="color: #32ff7e;"></i>
    </a>
</div>

<style>
    .bottom-appbar {
        display: flex;
        justify-content: space-around;
        align-items: center;
        background-color: #4e54c8; /* Original color */
        border-radius: 20px; /* Rounded edges like in the first image */
        padding: 15px; /* Adjust padding to ensure the correct size */
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.4); /* Add a subtle shadow */
    }

    .bottom-appbar a {
        text-decoration: none;
        color: #9fa6b2; /* Subtle color for the icons */
        transition: transform 0.2s ease-in-out;
    }

    .bottom-appbar a:hover {
        transform: scale(1.1); /* Slight scaling effect on hover */
    }

    .menu-icon {
        font-size: 1.8rem; /* Icon size matching the original design */
    }

    /* Style for the settings icon specifically */
    .bottom-appbar a:last-child .menu-icon {
        color: #32ff7e; /* Highlight color for the settings icon */
    }
</style>
