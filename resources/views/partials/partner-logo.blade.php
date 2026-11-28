@if(($partner ?? '') === 'trc')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 260 90" fill="none" class="{{ $class ?? 'h-12 w-28' }}" role="img" aria-label="TRC SGR Logo">
        <rect width="260" height="90" rx="12" fill="#FFFFFF"/>
        <path d="M24 18H74V29H55V62H42V29H24V18Z" fill="#7C1D18"/>
        <path d="M80 18H116C127 18 134 24 134 33C134 40 129 45 121 47L136 62H119L106 48H93V62H80V18ZM93 28V39H113C118 39 121 37 121 33.5C121 30 118 28 113 28H93Z" fill="#7C1D18"/>
        <rect x="76" y="29" width="22" height="3.5" fill="#FFFFFF"/>
        <rect x="76" y="36" width="26" height="3.5" fill="#FFFFFF"/>
        <rect x="76" y="43" width="20" height="3.5" fill="#FFFFFF"/>
        <path d="M168 18C180 18 189 23 193 31H178C175 28 172 27 167 27C158 27 153 32 153 40C153 48 158 53 167 53C172 53 176 51 179 48H194C189 57 180 62 167 62C150 62 139 53 139 40C139 27 150 18 168 18Z" fill="#7C1D18"/>
        <text x="130" y="79" text-anchor="middle" font-size="9.5" font-weight="700" letter-spacing="0.8" fill="#3F3F46">TANZANIA RAILWAYS CORPORATION • SGR</text>
    </svg>
@elseif(($partner ?? '') === 'air_tanzania')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 260 90" fill="none" class="{{ $class ?? 'h-12 w-28' }}" role="img" aria-label="Air Tanzania Logo">
        <rect width="260" height="90" rx="12" fill="#FFFFFF"/>
        <path d="M26 52C36 28 56 14 78 14C62 24 52 38 46 56L26 52Z" fill="#0072BC"/>
        <path d="M40 54C52 34 68 24 88 22C74 32 64 43 58 56L40 54Z" fill="#009B4D"/>
        <path d="M20 44C45 36 72 34 95 40C72 41 48 45 26 52L20 44Z" fill="#0072BC"/>
        <text x="102" y="45" font-size="22" font-weight="800" fill="#0072BC">Air Tanzania</text>
        <text x="104" y="60" font-size="9.5" font-style="italic" font-weight="600" fill="#009B4D">The Wings of Kilimanjaro</text>
    </svg>
@elseif(($partner ?? '') === 'precision_air')
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 260 90" fill="none" class="{{ $class ?? 'h-12 w-28' }}" role="img" aria-label="Precision Air Logo">
        <rect width="260" height="90" rx="12" fill="#FFFFFF"/>
        <circle cx="52" cy="45" r="28" fill="#FBBF24"/>
        <rect x="24" y="54" width="56" height="2.5" fill="#FFFFFF" opacity="0.85"/>
        <rect x="26" y="60" width="52" height="2.5" fill="#FFFFFF" opacity="0.85"/>
        <path d="M35 50C40 44 47 41 55 40C60 39 64 35 66 30L69 27L68 33C70 33 72 35 71 37C68 38 65 40 62 43C64 47 68 51 73 53L70 55C65 53 60 50 57 46C51 47 46 49 41 54L36 53L35 50Z" fill="#14532D"/>
        <text x="92" y="46" font-size="20" font-weight="800" fill="#14532D">Precision<tspan fill="#DC2626">Air</tspan></text>
        <text x="92" y="61" font-size="9.5" font-weight="600" fill="#71717A">Regional &amp; Domestic Aviation</text>
    </svg>
@endif
