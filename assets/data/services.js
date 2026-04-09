/**
 * Ocean Lilly Tours - Services Data
 * Premium services offered to all travelers
 * Displayed on homepage services section
 */

const services = [
  {
    id: 1,
    title: "VVIP Airport Pickup",
    slug: "vvip-airport-pickup",
    description: "Start your escape from the moment you land with luxury private transfers and lounge access.",
    long_description: "Our VVIP airport pickup service ensures your journey begins in style. From the moment you land at Colombo Bandaranaike International Airport, we take care of everything. Enjoy premium lounge access, hassle-free immigration assistance, and a luxurious private vehicle transfer to your accommodation.",
    icon: "flight_takeoff",
    icon_bg_color: "bg-primary/10",
    icon_hover_color: "group-hover:bg-primary",
    order: 1,
    featured: true
  },
  {
    id: 2,
    title: "Custom Itineraries",
    slug: "custom-itineraries",
    description: "Designed specifically for your pace, interests, and dietary preferences.",
    long_description: "Every traveler is unique, and your journey should reflect that. Our custom itinerary design service allows you to create the perfect trip tailored to your interests, pace, and preferences. Whether you're seeking adventure, relaxation, cultural immersion, or a mix of everything, we'll craft your ideal experience.",
    icon: "edit_calendar",
    icon_bg_color: "bg-secondary/10",
    icon_hover_color: "group-hover:bg-secondary",
    order: 2,
    featured: true
  },
  {
    id: 3,
    title: "Luxury Safari",
    slug: "luxury-safari",
    description: "Private 4x4 tours through Yala or Udawalawe with expert wildlife naturalists.",
    long_description: "Experience wildlife encounters in comfort and style. Our luxury safari service provides private 4x4 vehicles and knowledgeable naturalists who will expertly guide you through Yala National Park or Udawalawe National Park. Spot leopards, elephants, and rare bird species while enjoying the comfort of premium accommodations.",
    icon: "nature_people",
    icon_bg_color: "bg-tertiary/10",
    icon_hover_color: "group-hover:bg-tertiary",
    order: 3,
    featured: true
  }
];

window.services = services;
