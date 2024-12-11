# LaravelChallengePatientRegistration
A patient registration api using Laravel, storing the data in a MySQL database and running them on Docker

Used sail-8.4 and mysql-server:8.0

## Setting up the project

### **1. Start Docker**
Ensure Docker is running and start the containers by navigating to the project folder and using the appropriate Docker commands (e.g., `docker-compose up -d`).

### **2. Apply Migrations**
Always remember to apply migrations to keep the database schema up-to-date with the codebase:
```bash
docker exec -it patient-registration-laravel.test-1 php artisan migrate
```

### **3. Reset the Database**
If you need to reset the database, follow these steps:

1. Enter the MySQL container:
```bash
docker exec -it patient-registration-mysql-1 mysql -usail -ppassword
```

```sql
USE patient_registration;
TRUNCATE TABLE patients;
```

## Setting Up Postman Working Directory

I used a postman collection to facilitate testing. To ensure all file uploads in the Postman collection work correctly, follow these steps to set the working directory in Postman:

### 1. Open Postman Settings
- Launch Postman.
- Click on the gear icon in the top-right corner to open **Settings**.

### 2. Set the Working Directory
- Navigate to the **General** tab in the settings window.
- Scroll down to the **Working Directory** section.
- Click **Choose Folder** and select the folder where:
  - The Postman collection is located.
  - The files to be uploaded (e.g., `document_photo.jpg`) are stored.
- After selecting the folder, click **Save** to apply the changes.

### 3. Verify File References
- When running requests that require file uploads, ensure the file names in the Postman request match the actual file names in the working directory.

## Development Notes

### Key Decisions
1. Timestamps in the Database
   - Timestamps are used in the database purely for logging purposes, allowing for tracking of record creation and updates.

2. Default Files 
   - Some default Laravel files were retained(though they are not needed) to ensure compatibility and to expedite development.

3. Unique Email Validation
   - The email field in the `patients` table was set to be unique to prevent duplicate registrations.

4. Photo Storage Location  
   - Uploaded photos are stored in the following directory:
     ```
     patient-registration/storage/app/public/documents
     ```

5. Event-Based Notification System  
   - An event is triggered each time a new patient is registered.  
   - The `PatientRegisteredEmailNotification` listener asynchronously sends a confirmation email upon event dispatch.  
   - The system is designed to be easily extendable. For example, adding SMS notifications is as simple as attaching another listener to the same event.

6. Queue Worker for Asynchronous Tasks
   - A queue worker was implemented to handle the email notification process asynchronously, ensuring the application remains responsive during user registration.

### Proof of work
![Screenshot 2024-12-11 135348](https://github.com/user-attachments/assets/258540f1-2c22-4229-b324-150bbcea41d0)

