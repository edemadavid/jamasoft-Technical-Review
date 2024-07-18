Here's the complete `README.md` file in Markdown format:

```markdown
# Web Directory API

This project is a Laravel-based RESTful API for managing a web directory. It includes features for website submission, voting, and user management.

## Table of Contents

- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Setup](#setup)
- [Running the Application](#running-the-application)
- [Testing the API](#testing-the-api)
- [Contributing](#contributing)
- [License](#license)

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP (>= 8.3.7)
- Composer
- MySQL (8.0.30) or another supported database
- Node.js and npm (for optional frontend setup)

## Installation

1. **Clone the Repository**

   ```bash
   git clone https://github.com/your-username/your-repository.git
   cd your-repository
   ```

2. **Install PHP Dependencies**

   ```bash
   composer install
   ```

3. **Set Up the Environment File**

   Copy the example environment file and edit it for your local setup:

   ```bash
   cp .env.example .env
   ```

   Open `.env` and configure the following:

   ```dotenv
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password

   # Other settings
   ```

4. **Generate the Application Key**

   ```bash
   php artisan key:generate
   ```

5. **Run Migrations**

   Create the necessary tables in your database:

   ```bash
   php artisan migrate
   ```

6. **Seed the Database (Optional)**

   Seed initial data into the database (e.g., categories):

   ```bash
   php artisan db:seed
   ```

7. **Install JavaScript Dependencies (Optional)**

   If you have a frontend setup:

   ```bash
   npm install
   ```

8. **Build Frontend Assets (Optional)**

   ```bash
   npm run dev
   ```

## Setup

1. **Configure Your Database**

   Ensure that your database is running and that the credentials in your `.env` file are correct.

2. **Set Up API Authentication**

   If you're using Laravel Sanctum for API authentication, follow the Sanctum setup instructions:

   ```bash
   php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
   php artisan migrate
   ```

   Add Sanctum's middleware to your `api` middleware group in `app/Http/Kernel.php`:

   ```php
   'api' => [
       \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
       'throttle:api',
       \Illuminate\Routing\Middleware\SubstituteBindings::class,
   ],
   ```

3. **Configure Mail (Optional)**

   If your application sends emails, set up your mail configuration in `.env`.

## Running the Application

To start the Laravel development server:

```bash
php artisan serve
```

Visit `http://localhost:8000` in your browser to access the application.

## Testing the API

Use tools like Postman or curl to test the API endpoints. Here are some examples:

Based on the routes you've provided, here's a summary of the API endpoints and their purposes. I'll also include details on how to generate the controllers and the associated routes if needed.

### API Endpoints

#### Authentication Routes

- **POST** `/v1/auth/signup`
  - **Action**: `signup`
  - **Description**: Register a new user.

- **POST** `/v1/auth/verify-otp`
  - **Action**: `verifyOTP`
  - **Description**: Verify the OTP sent to the user.

- **POST** `/v1/auth/resend-otp`
  - **Action**: `resendOTP`
  - **Description**: Resend the OTP to the user.

- **POST** `/v1/auth/reset-password`
  - **Action**: `resetPassword`
  - **Description**: Reset the user’s password.

- **POST** `/v1/auth/login`
  - **Action**: `login`
  - **Description**: Authenticate a user and return a token.

#### Authenticated Routes (Requires `auth:sanctum` middleware)

- **POST** `/v1/auth/logout`
  - **Action**: `logout`
  - **Description**: Log out the authenticated user.

- **GET** `/v1/user/info`
  - **Action**: `getUserInfo`
  - **Description**: Get information about the authenticated user.

- **POST** `/v1/user/update`
  - **Action**: `updateUserInfo`
  - **Description**: Update the authenticated user’s information.
  

  ### Website Route: `/v1/user/website/{website}/vote`

- **GET** `/v1/user/websites`
  - **Action**: `index`
  - **Description**: Retrieve a list of websites associated with the authenticated user.
  
- **POST** `/v1/user/websites`
  - **Action**: `store`
  - **Description**: Create a new website for the authenticated user.
  
- **GET** `/v1/user/websites/{website}`
  - **Action**: `show`
  - **Description**: Retrieve details of a specific website associated with the authenticated user.
  
- **PUT** `/v1/user/websites/{website}`
  - **Action**: `update`
  - **Description**: Update details of a specific website associated with the authenticated user.
  
- **DELETE** `/v1/user/websites/{website}`
  - **Action**: `destroy`
  - **Description**: Delete a specific website associated with the authenticated user.


### Vote Route: `/v1/user/website/{website}/vote`

- **POST** `/v1/user/website/{website}/vote`
  - **Action**: `vote`
  - **Description**: Vote for a specific website.





### Example Request to Vote

```bash
curl -X POST \
  http://localhost:8000/api/v1/websites/1/vote \
  -H "Authorization: Bearer YOUR_API_TOKEN" \
  -H "Content-Type: application/json"
```

## Contributing

Feel free to submit pull requests or open issues. For major changes, please open an issue first to discuss what you would like to change.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
```

This `README.md` provides a comprehensive guide to setting up the project, including all the necessary steps and configurations. Make sure to replace placeholders with actual values relevant to your project.
