document.getElementById('addBookForm').addEventListener('submit', function(event) {
  event.preventDefault();

  let title = document.getElementById('title').value;
  let author = document.getElementById('author').value;
  let isbn = document.getElementById('isbn').value;
  let year = document.getElementById('year').value;
  let publisher = document.getElementById('publisher').value;
  let genre = document.getElementById('genre').value;
  let copies = document.getElementById('copies').value;

  if (!title || !author || !isbn || !year || !copies) {
    alert('Please fill in all required fields.');
    return;
  }

  if (!/^\d{13}$/.test(isbn)) {
    alert('Please enter a valid 13-digit ISBN.');
    return;
  }

  let booksTable = document.getElementById('booksTable').getElementsByTagName('tbody')[0];
  let newRow = booksTable.insertRow();
  newRow.insertCell(0).innerText = title;
  newRow.insertCell(1).innerText = author;
  newRow.insertCell(2).innerText = isbn;
  newRow.insertCell(3).innerText = year;
  newRow.insertCell(4).innerText = publisher;
  newRow.insertCell(5).innerText = genre;
  newRow.insertCell(6).innerText = copies;

  document.getElementById('addBookForm').reset();
});
