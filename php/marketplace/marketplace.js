const animals = [
  { id: 1, class: 'Chickens', image: 'manoks2.png', price: '100.00' },
  { id: 2, class: 'Chickens', image: 'manoks2.png', price: '100.00' },
  { id: 3, class: 'Chickens', image: 'manoks2.png', price: '100.00' },
  { id: 4, class: 'Chickens', image: 'manoks2.png', price: '100.00' },
  { id: 5, class: 'Goats', image: 'manoks2.png', price: '100.00' },
  { id: 6, class: 'Goats', image: 'manoks2.png', price: '100.00' },
  { id: 7, class: 'Goats', image: 'manoks2.png', price: '100.00' },
  { id: 8, class: 'Goats', image: 'manoks2.png', price: '100.00' },
  { id: 9, class: 'Goats', image: 'manoks2.png', price: '100.00' },
  { id: 10, class: 'Goats', image: 'manoks2.png', price: '100.00' },
  { id: 12, class: 'Goats', image: 'manoks2.png', price: '100.00' },
  { id: 13, class: 'Ducks', image: 'manoks2.png', price: '100.00' },
  { id: 14, class: 'Goats', image: 'manoks2.png', price: '100.00' },
  { id: 15, class: 'Goats', image: 'manoks2.png', price: '100.00' },
  { id: 16, class: 'Reptile', image: 'manoks2.png', price: '100.00' },
  { id: 17, class: 'Ducks', image: 'manoks2.png', price: '100.00' },
  { id: 18, class: 'Chickens', image: 'manoks2.png', price: '100.00' },
  { id: 19, class: 'Chickens', image: 'manoks2.png', price: '100.00' },
];

const container = document.getElementById('card-container');

function renderCards() {
  const filters = Array.from(document.querySelectorAll('.filter-group input:checked')).map(el => el.value);
  container.innerHTML = '';
  animals
    .filter(mode => filters.includes(mode.class))
    .forEach(mode => {
      const card = document.createElement('div');
      card.className = 'card';
      card.innerHTML = `
        <a href="../marketplace/animaldescription.html" class="sectioning"><img src="${mode.image}" alt="${mode.class}">
        <h3>${mode.class}</h3></a>
        <p class="price">${mode.price}</p>
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
