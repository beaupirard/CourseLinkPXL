<p align="center">
  <img src="images/logo_for_readme.jpg" width="200">
</p>

# About

CourseLinkPXL is a universal web application for managing educational processes in training centers.

CourseLinkPXL allows administrators, teachers, and students to effectively collaborate, manage courses, schedules, internships, and assessments through a simple and intuitive interface.

CourseLinkPXL was developed as a training assignment but can be used in real-world conditions to:

- Improve the organization of the educational process:
    - Centralized storage of information about courses, schedules, internships, and assessments
    - Automation of routine tasks
    - Increased transparency and accessibility of information for all participants

- Increase learning efficiency:
    - Personalization of learning
    - Providing feedback in real time
    - Stimulating independent student work

- Reduce costs:
    - Reduction of paperwork
    - Automation of control and evaluation

CourseLinkPXL is a reliable and easy-to-use tool that will help you improve the quality of education at your training center.

## Functionality

- CRUD operations:
    - Administrators: courses, teachers, skills
    - Teachers: students, internships
- Assignment:
    - Administrators: teachers to courses
- Grading:
    - Teachers: students for the academic year
- Export:
    - Teachers: grades to PDF and/or email

## Technologies

- Backend: PHP
- Database: MySQL
- Frontend: HTML, CSS, JavaScript
- Version control system: Git
- Task management: Trello Kanban

## Repository structure

- `app`: Contains PHP code
- `config`: Configuration files
- `database`: SQL scripts for creating and managing the database
- `public`: HTML, CSS, and JavaScript files
- `tests`: PHPUnit tests

## Instructions for running

1. Clone the repository
2. Install Composer
3. Run `composer install`
4. Create a `.env` file in the root folder of the repository and specify the database connection parameters in it
5. Run `php artisan serve`

## License

This project is licensed under the [MIT License](https://opensource.org/licenses/MIT).
