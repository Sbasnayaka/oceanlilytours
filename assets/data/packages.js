/**
 * Ocean Lilly Tours - Packages Data
 * Complete package information with itineraries
 * Structure ready for backend integration
 */

const packages = [
  {
    id: 1,
    name: "7 Day Nature Explorer",
    slug: "nature-explorer",
    duration_days: 7,
    category: "nature-wellness",
    category_label: "Nature & Wellness",
    tag: "Nature & Wellness",
    tag_color: "bg-tertiary",
    price: 1250,
    featured: true,
    description: "Discover the misty hills of Ella, the ancient temples of Kandy, and the lush wildlife of Yala.",
    long_description: "The 7-Day Nature Explorer is the perfect immersive experience for travelers seeking to witness the true essence of Sri Lanka. This carefully crafted journey spans the island's most stunning natural and cultural landmarks, from the sacred temples of Kandy to the breathtaking peaks of Ella and the wildlife-rich landscapes of Yala National Park. You will experience the tranquility of tea plantations, the thrill of wildlife safaris, and the warmth of local hospitality.",
    featured_image: "assets/uploads/package-nature-explorer.jpg",
    thumbnail_image: "assets/uploads/package-nature-explorer-thumb.jpg",
    destinations: ["Negombo", "Kandy", "Dambulla", "Sigiriya", "Nuwara Eliya", "Ella", "Yala"],
    destinations_count: 8,
    tour_type: "Nature & Culture",
    best_for: "Families",
    includes: [
      "6 Nights Accommodation",
      "Daily Breakfast",
      "All Activities & Entrance Fees",
      "Professional Driver & Guide",
      "Airport Transfers",
      "Travel Insurance"
    ],
    itinerary: [
      {
        day: 1,
        location: "Negombo",
        title: "Arrival in Colombo → Negombo",
        tag: "Arrival",
        tag_color: "bg-gradient-to-r from-secondary to-ocean-blue",
        description: "When you arrive at Colombo Bandaranaike International Airport, our professional driver will pick you up and transfer you to your hotel in Negombo. Negombo is located just 30km from the airport, making it the ideal place to rest and acclimate before exploring the rest of Sri Lanka.",
        activities: [
          "Visit Negombo Beach and the historic fishing village",
          "Dinner at a beachfront restaurant with local cuisine",
          "Experience the warm hospitality of local residents"
        ],
        image: "assets/uploads/itinerary-negombo.jpg",
        meals: "Dinner"
      },
      {
        day: 2,
        location: "Kandy",
        title: "Negombo → Kandy",
        tag: "Nature",
        tag_color: "bg-primary",
        description: "After breakfast, embark on a scenic 3-hour journey to the cultural heart of Sri Lanka. Visit the renowned Millennium Elephant Foundation for an unforgettable elephant encounter. In the afternoon, arrive in Kandy and check into your hotel overlooking the sacred Kandy Lake.",
        activities: [
          "Elephant Walk Experience and feeding",
          "Transfer to Kandy (3 hours)",
          "Evening Cultural Dance Show at 5:30 PM",
          "Explore sacred Buddhist temples"
        ],
        image: "assets/uploads/itinerary-kandy.jpg",
        meals: "Breakfast, Lunch, Dinner"
      },
      {
        day: 3,
        location: "Kandy",
        title: "Kandy City Tour",
        tag: "Culture",
        tag_color: "bg-secondary",
        description: "Explore the sacred Temple of the Tooth Relic, one of Buddhism's holiest sites. Visit the Royal Botanical Gardens with over 4,000 species of tropical plants, and discover the historic Kandy Lake.",
        activities: [
          "Temple of the Tooth Relic visit",
          "Royal Botanical Gardens exploration",
          "Kandy Lake scenic walk",
          "Local market and craft shops"
        ],
        image: "assets/uploads/itinerary-kandy-temple.jpg",
        meals: "Breakfast, Lunch, Dinner"
      },
      {
        day: 4,
        location: "Sigiriya",
        title: "Kandy → Dambulla → Sigiriya",
        tag: "Adventure",
        tag_color: "bg-eco-green",
        description: "Visit the Royal Cave Temple in Dambulla, a sacred pilgrimage site for 22 centuries. Hike to the top of the iconic Sigiriya Rock, often called the 'Eighth Wonder of the World,' for spectacular views and ancient palace ruins.",
        activities: [
          "Royal Cave Temple in Dambulla visit",
          "Sigiriya Rock fortress climbing",
          "Ancient palace ruins exploration",
          "Panoramic sunset views"
        ],
        image: "assets/uploads/itinerary-sigiriya.jpg",
        meals: "Breakfast, Lunch, Dinner"
      },
      {
        day: 5,
        location: "Nuwara Eliya",
        title: "Sigiriya → Nuwara Eliya",
        tag: "Heritage",
        tag_color: "bg-secondary",
        description: "Journey to 'Little England' - Nuwara Eliya, a charming hill station with colonial architecture. Visit scenic lakes, tea factories, and enjoy the cool mountain climate at 6,000 feet elevation.",
        activities: [
          "Colonial architecture exploring",
          "Lake Gregory visit",
          "Tea factory tour",
          "Cool mountain climate experience"
        ],
        image: "assets/uploads/itinerary-nuwara-eliya.jpg",
        meals: "Breakfast, Lunch, Dinner"
      },
      {
        day: 6,
        location: "Ella",
        title: "Nuwara Eliya → Ella",
        tag: "Nature",
        tag_color: "bg-tertiary",
        description: "Experience the famous scenic train ride from Nanu Oya to Ella (about 7 hours). This journey is considered one of the world's most beautiful train routes, passing through tea plantations and mountain valleys. Arrive in the scenic town of Ella and explore the iconic Nine Arches Bridge and Little Adam's Peak.",
        activities: [
          "Famous scenic train ride (7 hours)",
          "Tea plantation views",
          "Nine Arches Bridge visit",
          "Little Adam's Peak hiking"
        ],
        image: "assets/uploads/itinerary-ella-train.jpg",
        meals: "Breakfast, Lunch, Dinner"
      },
      {
        day: 7,
        location: "Yala",
        title: "Ella → Yala → Departure",
        tag: "Wildlife",
        tag_color: "bg-secondary",
        description: "Begin your journey to Yala National Park with a full-day wildlife safari in a 4x4 jeep. Yala is home to leopards, elephants, and diverse bird species. After the safari, transfer to the airport for your departure with unforgettable memories.",
        activities: [
          "Full-day morning wildlife safari",
          "Leopard and elephant sightings",
          "Bird watching opportunities",
          "Transfer to airport"
        ],
        image: "assets/uploads/itinerary-yala-safari.jpg",
        meals: "Breakfast, Lunch"
      }
    ],
    highlights: [
      {
        icon: "landscape",
        title: "Tea Plantations & Highland Views",
        description: "Experience the world's finest tea country with rolling green hills and scenic viewpoints at elevation."
      },
      {
        icon: "temple_buddhist",
        title: "Sacred Temples & Cultural Sites",
        description: "Visit UNESCO World Heritage Sites including ancient temples and spiritual landmarks deeply rooted in Buddhist culture."
      },
      {
        icon: "pets",
        title: "Wildlife Safari Experience",
        description: "Full-day jeep safari in Yala National Park to spot leopards, elephants, and exotic bird species in their natural habitat."
      },
      {
        icon: "train",
        title: "Scenic Train Journey",
        description: "Experience one of the world's most beautiful train routes through misty mountains and emerald green tea estates."
      }
    ],
    tips: [
      {
        icon: "info",
        title: "Packing for Multiple Climates",
        description: "You will experience temperatures ranging from 30°C on the coast to as low as 10°C in Nuwara Eliya. Pack light linens for the beach and a warm fleece or jacket for the highlands. Don't forget waterproof gear for unexpected rain."
      },
      {
        icon: "document_scanner",
        title: "Visa & Documentation",
        description: "Ensure your ETA (Electronic Travel Authorization) is approved before arrival. Keep digital and physical copies of your passport, visa, and travel itinerary. Our team can assist with all documentation requirements."
      },
      {
        icon: "pace",
        title: "Pacing & Rest Days",
        description: "This is an active journey with daily exploration. Build in relaxation time, especially after long travel days. We recommend light activities on certain days to avoid burnout and truly savor each destination."
      },
      {
        icon: "train",
        title: "Train Ticket Booking",
        description: "The famous Nanu Oya to Ella train (Day 6) is world-renowned. Reserved seat tickets often sell out 30+ days in advance. We recommend booking these through our travel coordinators to ensure availability."
      }
    ]
  },
  {
    id: 2,
    name: "Honeymoon Escape",
    slug: "honeymoon-escape",
    duration_days: 7,
    category: "romantic-luxury",
    category_label: "Romantic Luxury",
    tag: "Romantic Luxury",
    tag_color: "bg-secondary",
    price: 2100,
    featured: true,
    description: "A private, candle-lit journey through Sri Lanka's most romantic boutique stays and golden beaches.",
    long_description: "Crafted for newlyweds and couples seeking intimacy and luxury, this journey combines pristine beaches, boutique accommodations, and exclusive experiences.",
    featured_image: "assets/uploads/package-honeymoon.jpg",
    thumbnail_image: "assets/uploads/package-honeymoon-thumb.jpg",
    destinations: ["Negombo", "Kandy", "Ella", "South Coast"],
    destinations_count: 4,
    tour_type: "Romantic Luxury",
    best_for: "Couples",
    includes: [
      "6 Nights Luxury Accommodation",
      "All Meals (Breakfast, Lunch, Dinner)",
      "Couples Spa Treatments",
      "Private Dining Experiences",
      "Airport Transfers",
      "Travel Insurance",
      "Romantic Setup & Special Touches"
    ],
    itinerary: []
  },
  {
    id: 3,
    name: "3 Day Highlights",
    slug: "3-day-highlights",
    duration_days: 3,
    category: "cultural-heritage",
    category_label: "Cultural Heritage",
    tag: "Cultural Heritage",
    tag_color: "bg-primary",
    price: 650,
    featured: false,
    description: "Perfect for those short on time but wanting to see the historic heart of the island.",
    long_description: "Cover the most iconic cultural sites in Sri Lanka in just 3 days. Perfect for travelers with limited time.",
    featured_image: "assets/uploads/package-highlights.jpg",
    thumbnail_image: "assets/uploads/package-highlights-thumb.jpg",
    destinations: ["Kandy", "Sigiriya", "Dambulla"],
    destinations_count: 3,
    tour_type: "Cultural Heritage",
    best_for: "Short-term Travelers",
    includes: [
      "2 Nights Accommodation",
      "Daily Breakfast",
      "Major Entrance Fees",
      "Professional Guide",
      "Airport Transfers"
    ],
    itinerary: []
  },
  {
    id: 4,
    name: "5 Day Island Paradise",
    slug: "island-paradise",
    duration_days: 5,
    category: "adventure-combo",
    category_label: "Adventure Combo",
    tag: "Adventure Combo",
    tag_color: "bg-tertiary",
    price: 950,
    featured: false,
    description: "Pristine beaches, coral reefs, and sunset sailing on the Indian Ocean.",
    long_description: "Experience the best of Sri Lanka's coastal beauty with beach relaxation, water activities, and cultural exploration.",
    featured_image: "assets/uploads/package-island.jpg",
    thumbnail_image: "assets/uploads/package-island-thumb.jpg",
    destinations: ["South Coast Beaches", "Coral Reefs", "Fishing Villages"],
    destinations_count: 5,
    tour_type: "Beach & Adventure",
    best_for: "Beach Lovers",
    includes: [
      "4 Nights Beachfront Accommodation",
      "Daily Breakfast",
      "Water Activities & Snorkeling",
      "Sunset Sailing",
      "Local Fishing Village Tour"
    ],
    itinerary: []
  },
  {
    id: 5,
    name: "Ayurveda Healing Retreat",
    slug: "ayurveda-retreat",
    duration_days: 7,
    category: "spa-wellness",
    category_label: "Spa & Wellness",
    tag: "Spa & Wellness",
    tag_color: "bg-secondary",
    price: 1800,
    featured: false,
    description: "Traditional Ayurvedic treatments, yoga sessions, and health restoration.",
    long_description: "Immerse yourself in the ancient healing traditions of Ayurveda at a luxury wellness resort.",
    featured_image: "assets/uploads/package-ayurveda.jpg",
    thumbnail_image: "assets/uploads/package-ayurveda-thumb.jpg",
    destinations: ["Wellness Resort", "Ayurvedic Center"],
    destinations_count: 1,
    tour_type: "Wellness",
    best_for: "Health-Conscious Travelers",
    includes: [
      "6 Nights Wellness Resort",
      "Daily Ayurvedic Treatments",
      "Yoga Sessions",
      "Healthy Meals",
      "Consultation with Ayurvedic Doctor"
    ],
    itinerary: []
  },
  {
    id: 6,
    name: "Central Highlands Explorer",
    slug: "highlands-explorer",
    duration_days: 5,
    category: "tea-country",
    category_label: "Tea Country Tour",
    tag: "Tea Country Tour",
    tag_color: "bg-primary",
    price: 1100,
    featured: false,
    description: "Tea plantations, mountain trains, waterfalls, and cool climate villages.",
    long_description: "Journey through Sri Lanka's stunning tea-growing regions with visits to plantations and mountain experiences.",
    featured_image: "assets/uploads/package-highlands.jpg",
    thumbnail_image: "assets/uploads/package-highlands-thumb.jpg",
    destinations: ["Nuwara Eliya", "Ella", "Tea Plantations"],
    destinations_count: 5,
    tour_type: "Tea & Mountains",
    best_for: "Adventure Seekers",
    includes: [
      "4 Nights Mountain Accommodation",
      "Tea Factory Tours",
      "Train Ride",
      "Hiking Experiences",
      "Waterfall Visits"
    ],
    itinerary: []
  },
  {
    id: 7,
    name: "Ancient Kingdoms Tour",
    slug: "ancient-kingdoms",
    duration_days: 5,
    category: "cultural-deep-dive",
    category_label: "Cultural Deep Dive",
    tag: "Cultural Deep Dive",
    tag_color: "bg-tertiary",
    price: 1350,
    featured: false,
    description: "Sacred temples, ancient ruins, palace complexes, and cultural sites.",
    long_description: "Explore Sri Lanka's rich history and cultural heritage through ancient kingdoms and archaeological sites.",
    featured_image: "assets/uploads/package-kingdoms.jpg",
    thumbnail_image: "assets/uploads/package-kingdoms-thumb.jpg",
    destinations: ["Sacred Temple Sites", "Ancient Ruins", "Historical Centers"],
    destinations_count: 6,
    tour_type: "Historical",
    best_for: "History Enthusiasts",
    includes: [
      "4 Nights Accommodation",
      "All UNESCO Site Entries",
      "Archaeology-Focused Guide",
      "Cultural Workshops",
      "Fine Dining Experiences"
    ],
    itinerary: []
  },
  {
    id: 8,
    name: "All-Inclusive Grand Tour",
    slug: "grand-tour",
    duration_days: 14,
    category: "premium-luxury",
    category_label: "Premium Luxury",
    tag: "Premium Luxury",
    tag_color: "bg-secondary",
    price: 3200,
    featured: true,
    description: "14 days experiencing everything: beaches, mountains, wildlife, and luxury stays.",
    long_description: "The ultimate Sri Lanka experience combining all the highlights - beaches, mountains, cultural sites, and wildlife in one comprehensive luxury tour.",
    featured_image: "assets/uploads/package-grand-tour.jpg",
    thumbnail_image: "assets/uploads/package-grand-tour-thumb.jpg",
    destinations: ["Negombo", "Kandy", "Sigiriya", "Nuwara Eliya", "Ella", "South Coast", "Yala"],
    destinations_count: 9,
    tour_type: "Comprehensive",
    best_for: "First-time Visitors",
    includes: [
      "13 Nights 5-Star Accommodation",
      "All Meals & Premium Dining",
      "All Activities & Entrance Fees",
      "Private Vehicle & Expert Guide",
      "Airport Transfers",
      "Travel Insurance",
      "Spa Services"
    ],
    itinerary: []
  }
];
