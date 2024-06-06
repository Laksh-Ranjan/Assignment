class Book:
    def __init__(self, title, author, isbn, year):
        self.title = title
        self.author = author
        self.isbn = isbn
        self.year = year
        self.is_borrowed = False

    def __str__(self):
        status = "Borrowed" if self.is_borrowed else "Available"
        return f"Title: {self.title}, Author: {self.author}, ISBN: {self.isbn}, Year: {self.year}, Status: {status}"

class Library:
    def __init__(self):
        self.books = []

    def add_book(self, title, author, isbn, year):
        new_book = Book(title, author, isbn, year)
        self.books.append(new_book)
        print(f"Book '{title}' added successfully.")

    def view_books(self):
        if not self.books:
            print("No books in the library.")
        else:
            for book in self.books:
                print(book)

    def search_books(self, query, search_by="title"):
        found_books = [book for book in self.books if query.lower() in getattr(book, search_by).lower()]
        if not found_books:
            print(f"No books found by {search_by} '{query}'.")
        else:
            for book in found_books:
                print(book)

    def borrow_book(self, title):
        for book in self.books:
            if book.title.lower() == title.lower():
                if book.is_borrowed:
                    print(f"Book '{title}' is already borrowed.")
                else:
                    book.is_borrowed = True
                    print(f"You have borrowed '{title}'.")
                return
        print(f"Book '{title}' not found in the library.")

    def return_book(self, title):
        for book in self.books:
            if book.title.lower() == title.lower():
                if book.is_borrowed:
                    book.is_borrowed = False
                    print(f"You have returned '{title}'.")
                else:
                    print(f"Book '{title}' was not borrowed.")
                return
        print(f"Book '{title}' not found in the library.")

def main():
    library = Library()

    while True:
        print("\nLibrary Menu:")
        print("1. Add new book")
        print("2. View all books")
        print("3. Search for a book by title")
        print("4. Search for a book by author")
        print("5. Borrow a book")
        print("6. Return a book")
        print("7. Exit")
        
        choice = input("Enter your choice: ")

        if choice == "1":
            title = input("Enter book title: ")
            author = input("Enter book author: ")
            isbn = input("Enter book ISBN: ")
            year = input("Enter book year: ")
            library.add_book(title, author, isbn, year)
        elif choice == "2":
            library.view_books()
        elif choice == "3":
            title = input("Enter book title to search: ")
            library.search_books(title, "title")
        elif choice == "4":
            author = input("Enter book author to search: ")
            library.search_books(author, "author")
        elif choice == "5":
            title = input("Enter book title to borrow: ")
            library.borrow_book(title)
        elif choice == "6":
            title = input("Enter book title to return: ")
            library.return_book(title)
        elif choice == "7":
            print("Exiting the library system.")
            break
        else:
            print("Invalid choice. Please try again.")

if __name__ == "__main__":
    main()
