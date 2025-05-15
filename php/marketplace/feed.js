const animals = [
  { id: 1, description: 'Chickens', image: 'LivestockFeed/sarimanok.jpg', class: 'Sarimanok Chicken Booster' },
  { id: 2, description: 'Chickens', image: 'LivestockFeed/sarimanok.pLjpg.jpg', class: 'Sarimanok Pre - Lay' },
  { id: 3, description: 'Goats', image: 'LivestockFeed/Hay.jpg', class: 'Hay Forage' },
  { id: 4, description: 'Chickens', image: 'LivestockFeed/sarimanokbs.jpg', class: 'Sarimanok Broiler Starter' },
  { id: 5, description: 'Chickens', image: 'LivestockFeed/sarimanok.pL1.jpg', class: 'Sarimanok Pre - Lay 2' },
  { id: 6, description: 'Chickens', image: 'LivestockFeed/broilerfinisher.png', class: 'Sariamnok Broiler Finisher' },
  { id: 7, description: 'Ducks', image: 'LivestockFeed/plimico.jpg', class: 'Avemax' },
  { id: 8, description: 'Cows', image: 'LivestockFeed/DAIRYCATTLE.png', class: 'Dairy Cattle' },
];

const container = document.getElementById('card-container');

function renderCards() {
  const filters = Array.from(document.querySelectorAll('.filter-group input:checked')).map(el => el.value);
  container.innerHTML = '';
  animals
    .filter(mode => filters.includes(mode.description))
    .forEach(mode => {
      const card = document.createElement('div');
      card.className = 'card';
      card.innerHTML = `
        <a href="../marketplace/feeddescription.html" class="sectioning"><img src="${mode.image}" alt="${mode.description}">
        <h3>${mode.description}</h3></a>
        <p class="price">${mode.class}</p>
      `;
      container.appendChild(card);
    });
}

document.querySelectorAll('.filter-group input').forEach(input => {
  input.addEventListener('change', renderCards);
});

renderCards();

const track = document.querySelector('.carousel-track');
  const items = track.children;

  // Clone the first 3 items to make the loop seamless
  for (let i = 0; i < 3; i++) {
    const clone = items[i].cloneNode(true);
    track.appendChild(clone);
  }
