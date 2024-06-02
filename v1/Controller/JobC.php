<?php

require_once __DIR__ . '/../config.php';
require_once 'profileController.php';

class JobController
{
    private $conn;

    public function __construct()
    {
        $this->conn = config::getConnexion(); // Get PDO connection
    }

    // Function to get education level for a given category
    /*
// Function to retrieve user profile education based on user ID
public function getUserProfileEducation($userId) {
    try {
        // Prepare and execute query to fetch user profile education
        $stmt = $this->conn->prepare("SELECT profile_education FROM profile WHERE profile_userid = ?");
        $stmt->execute([$userId]);
        $userProfileEducation = $stmt->fetchColumn(); // Assuming only one education per user
        
        return $userProfileEducation;
    } catch (PDOException $e) {
        // Handle any errors, such as database connection errors
        return "Error: " . $e->getMessage();
    }
}
*/

    public function fetchJobsByCategory($categoryId, $limit = null)
    {
        try {
            // Prepare SQL query to fetch jobs based on category ID and join with the categories table to get category name
            $sql = "SELECT j.*, c.name_category AS category_name FROM jobs j
                INNER JOIN categories c ON j.category = c.id_category
                WHERE j.category = ?";

            // If $limit is specified, add LIMIT clause to the SQL query
            if ($limit !== null) {
                $sql .= " LIMIT $limit";
            }

            // Prepare and execute SQL query
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$categoryId]);
            $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $jobs; // Return fetched jobs
        } catch (PDOException $e) {
            // Handle database error
            return false;
        }
    }

    // Define the function to fetch jobs by education level
    function fetchJobsByEducationLevel($profileId)
    {
        // Create instances of ProfileController and JobController
        $profileController = new ProfileC();
        $jobController = new JobController();

        // Fetch profile data to get the education level
        $profileData = $profileController->getProfileById($profileId);

        // Check if profile data was fetched successfully
        if ($profileData) {
            // Get the education level from the profile data
            $educationLevel = $profileController->getProfileEducation($profileId); // Use the ProfileController method

            // Fetch jobs based on education level
            $jobs = $jobController->fetchJobsByCategory($educationLevel); // Assuming you have a method to fetch jobs by category

            // Return the fetched jobs
            return $jobs;
        } else {
            // Handle the case where profile data could not be fetched
            return false;
        }
    }
    // Create a new job
    // Create a new job
    public function createJob($job_id, $title, $company, $location, $description, $salary, $category, $job_image, $profile_id)
    {
        try {
            // Fetch the id_category based on the selected category
            $stmt = $this->conn->prepare("SELECT id_category FROM category WHERE name_category = ?");
            $stmt->execute([$category]);
            $categoryResult = $stmt->fetch(PDO::FETCH_ASSOC);
            $categoryID = $categoryResult['id_category'];

            // Get the current date and time
            $date_posted = date("Y-m-d H:i:s");

            // Insert the job into the database with the provided profile ID
            $stmt = $this->conn->prepare("INSERT INTO jobs (id, title, company, location, description, salary, date_posted, job_image, id_category, jobs_profile) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$job_id, $title, $company, $location, $description, $salary, $date_posted, $job_image, $categoryID, $profile_id]);

            return "New job created successfully";
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }


    // Update a job
    public function updateJob($id, $title, $company, $location, $description, $salary, $category, $job_image)
    {
        try {

            // Fetch the id_category based on the selected category
            $stmt = $this->conn->prepare("SELECT id_category FROM category WHERE name_category = ?");
            $stmt->execute([$category]);
            $categoryResult = $stmt->fetch(PDO::FETCH_ASSOC);
            $categoryID = $categoryResult['id_category'];

            $stmt = $this->conn->prepare("UPDATE jobs SET title=?, company=?, location=?, description=?, salary=? , id_category=? , job_image=? WHERE id=?");
            $stmt->execute([$title, $company, $location, $description, $salary, $categoryID, $job_image, $id]);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function updateJobWithoutImage($id, $title, $company, $location, $description, $salary, $category)
    {
        try {

            // Fetch the id_category based on the selected category
            $stmt = $this->conn->prepare("SELECT id_category FROM category WHERE name_category = ?");
            $stmt->execute([$category]);
            $categoryResult = $stmt->fetch(PDO::FETCH_ASSOC);
            $categoryID = $categoryResult['id_category'];

            $stmt = $this->conn->prepare("UPDATE jobs SET title=?, company=?, location=?, description=?, salary=? , id_category=? WHERE id=?");
            $stmt->execute([$title, $company, $location, $description, $salary, $categoryID, $id]);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }


    public function updateJobImage($id, $job_image_data)
    {
        try {

            $tableName = "jobs";
            // Prepare SQL statement to update profile picture
            $sql = "UPDATE $tableName SET job_image = :job_image WHERE id = :id";
            $stmt = $this->conn->prepare($sql);

            // Bind parameters
            $stmt->bindParam(':id', $id, PDO::PARAM_STR);
            $stmt->bindParam(':job_image', $job_image_data, PDO::PARAM_LOB);

            // Execute the query
            $stmt->execute();

            // Check if the update was successful
            if ($stmt->rowCount() > 0) {
                return true; // Return true if update successful
            } else {
                return false; // Return false if update failed
            }
        } catch (PDOException $e) {
            // Handle database errors
            echo "Error: " . $e->getMessage();
            return false; // Return false if an error occurred
        }
    }


    // Read all jobs
    public function getAllJobs()
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM jobs ORDER BY date_posted ");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
    // Delete a job
    public function deleteJob($id)
    {
        try {
            $stmt = $this->conn->prepare("DELETE FROM jobs WHERE id=?");
            $stmt->execute([$id]);
            return "Job deleted successfully";
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    /*
    // Get all jobs
    public function getJobs()
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM jobs");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    */
    /*
    // Read a job by ID
    public function readJob($id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM jobs WHERE id=?");
            $stmt->execute([$id]);
            $result = $stmt->fetch();
            return $result ? $result : "Job not found";
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
*/
    public function generateId($id_length)
    {
        $numbers = '0123456789';
        $numbers_length = strlen($numbers);
        $random_id = '';

        // Generate random ID
        for ($i = 0; $i < $id_length; $i++) {
            $random_id .= $numbers[rand(0, $numbers_length - 1)];
        }

        return (string) $random_id; // Ensure the return value is a string
    }


    public function jobExists($id)
    {
        $tableName = "jobs";

        $sql = "SELECT COUNT(*) as count FROM $tableName WHERE id = :id";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'] > 0;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    public function generateJobId($id_length)
    {
        do {
            $current_id = $this->generateId($id_length);
        } while ($this->jobExists($current_id));

        return $current_id;
    }


    public function generateCategoryOptions()
    {
        // Fetching the category IDs from the database
        $sql = "SELECT id_category, name_category FROM category";

        $db = config::getConnexion();

        try {
            $stmt = $db->query($sql);

            // Generating the <option> tags
            $options = '';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $options .= '<option value="' . $row['name_category'] . '">' . $row['name_category'] . '</option>';
            }

            return $options;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }
    // Fetch job data including category information
    public function getAllJobsWithCategory()
    {
        try {
            $stmt = $this->conn->prepare("SELECT jobs.*, category.name_category AS category_name FROM jobs INNER JOIN category ON jobs.id_category = category.id_category ORDER BY jobs.date_posted");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    /*
    public function generateCategoryOptionsselected($nom)
    {
        // Fetching the blog IDs from the database
        $sql = "SELECT id_category, name_category FROM category";

        $db = config::getConnexion();

        try {
            $stmt = $db->query($sql);

            // Generating the <option> tags
            $options = '';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                if ($nom == $row['name_category']) {
                    $options .= '<option selected value="' . $row['name_category'] . '">' . $row['name_category'] . '</option>';
                } else {

                    $options .= '<option value="' . $row['name_category'] . '">' . $row['name_category'] . '</option>';
                }
            }

            return $options;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }
    */

    /*
    // Get company id by category
    public function getCompanyIdByCategory($category)
    {
        try {
            $stmt = $this->conn->prepare("SELECT id_company FROM company WHERE category = ?");
            $stmt->execute([$category]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['id_company'] ?? null;
        } catch (PDOException $e) {
            return false;
        }
    }
*/

    /*
    public function getAllJobsSortedByProfileEducation()
    {
        try {
            // Query to fetch jobs sorted by profile education
            $sql = "SELECT j.*, c.name AS category_name 
                FROM job j
                INNER JOIN category c ON j.category_id = c.id_category
                INNER JOIN profile p ON c.name_category = p.profile_education
                ORDER BY p.profile_education DESC";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }*/


    public function generateProfileOptions()
    {
        // Fetching the profile IDs from the database
        $sql = "SELECT profile_id FROM profile";

        $db = config::getConnexion();

        try {
            $stmt = $db->query($sql);

            // Generating the <option> tags
            $options = '';
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $options .= '<option value="' . $row['profile_id'] . '">' . $row['profile_id'] . '</option>';
            }

            return $options;
        } catch (PDOException $e) {
            die('Error:' . $e->getMessage());
        }
    }


    public function getAllJobsSortedByProfileEducation($profile_id)
    {
        try {
            // Prepare and execute SQL query to fetch jobs sorted by profile education
            $stmt = $this->conn->prepare("
            SELECT jobs.*, category.name_category 
            FROM jobs 
            INNER JOIN category ON jobs.id_category = category.id_category
            INNER JOIN profile ON category.name_category = profile.profile_education
            WHERE profile.profile_id = ?
            ORDER BY 
                CASE 
                    WHEN profile.profile_education = 'Web Designing' THEN 1
                    WHEN profile.profile_education = 'Graphic Design' THEN 2
                    WHEN profile.profile_education = 'Software Engineering' THEN 3
                    ELSE 4
                END,
                jobs.id ASC
        ");
            $stmt->execute([$profile_id]);
            $sortedJobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Now fetch the remaining unsorted jobs
            $stmt = $this->conn->prepare("
            SELECT jobs.*, category.name_category 
            FROM jobs 
            LEFT JOIN category ON jobs.id_category = category.id_category
            WHERE jobs.id NOT IN (SELECT id FROM jobs WHERE id_category IN (
                SELECT id_category FROM category WHERE name_category IN (
                    SELECT profile_education FROM profile WHERE profile_id = ?
                )
            ))
        ");
            $stmt->execute([$profile_id]);
            $unsortedJobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Combine and return both sorted and unsorted jobs
            $allJobs = array_merge($sortedJobs, $unsortedJobs);
            return $allJobs;
        } catch (PDOException $e) {
            // Handle exception
            return [];
        }
    }

    public function getJobById($jobId)
    {
        try {
            // Prepare the SQL statement
            $stmt = $this->conn->prepare("SELECT * FROM jobs WHERE id = :job_id");

            // Bind parameters
            $stmt->bindParam(':job_id', $jobId);

            // Execute the statement
            $stmt->execute();

            // Fetch the apply record
            $apply = $stmt->fetch(PDO::FETCH_ASSOC);

            return $apply;
        } catch (PDOException $e) {
            // Handle any database errors
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public function getAllRecentJobs()
    {
        try {
            $stmt = $this->conn->prepare("SELECT jobs.id_category, jobs.date_posted, jobs.title, jobs.company, jobs.location, jobs.description, jobs.salary, jobs.jobs_profile FROM jobs 
                                        INNER JOIN category ON jobs.id_category = category.id_category 
                                        WHERE DATE(jobs.date_posted) = CURDATE() 
                                        ORDER BY jobs.date_posted");
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function getAllJobsWhereProfileId($profile_id)
    {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM jobs WHERE jobs_profile = :profile_id ORDER BY date_posted");
            $stmt->bindParam(':profile_id', $profile_id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
