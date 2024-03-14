 Exam Pass Automated System

The Exam Pass Automated System is a Laravel-based web application designed for managing the process of student exam pass issuance. It allows students to sign up, log in, and submit required documents. Admins can then validate these documents and approve/reject them accordingly. Once approved, students can print their exam passes.

 Features

- User Authentication: Secure user authentication system with signup and login functionality.
- Document Submission: Students can submit required documents for validation.
- Admin Panel: Admins have access to a dashboard where they can manage all student submissions, validate documents, and adjust deadline details.
- Document Validation: Admins can approve or reject submitted documents. Rejection emails are sent to users with details attached.
- Deadline Management: Admins can adjust the deadline for document submission.
- Dynamic Requirements: Admins can adjust required documents based on student levels.

 Usage

1. Clone the repository:

```
git clone <https://github.com/hibeefrosh/-Exam-Pass-Automated-System.git>
```

2. Install dependencies:

```
composer install
```

3. Copy `.env.example` to `.env` and configure your environment variables, including database settings and mail configuration(use yours).

4. Run database seeders:

5. Run database migrations:

```
php artisan migrate
```

6. Serve the application:

```
php artisan serve
```

7. Access the application in your web browser:

```
http://localhost:8000
```

 Admin Credentials

- Email: admin@example.com
- Password: password

 Contributing

Contributions are welcome! If you find any bugs or have suggestions for improvements, please open an issue or submit a pull request.


Note
This project serves as my ND 2 final project in the Moshood Abiola Polytechnic (MAPOLY).