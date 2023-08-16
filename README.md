### **Examining the server log file**

###### **Project description**
The project has been implemented using the PHP programming language without any frameworks. It utilizes an nginx server and PHP 8.1 with the assistance of Docker containers. The project accomplishes the following tasks:
1. What are the 10 license serial numbers that try to access the server the most? How many
   times are they trying to access the server?
2. One license serial number should only be active on one physical device. Describe how
   you identify a single device as such. Provide a way to identify licenses that are installed
   on more than one device. What are the 10 license serials that violoate this rule the most?
   On how many distinct devices are these licenses installed?
3. Bonus: Based on the information given in the specs metadata, try to identify the
   different classes of hardware that are in use and provide the number of licenses that are
   active on these types of hardware.

### **How to Install and Run the Project**
First place your log file as ./logfiles/updatev12-access-pseudonymized.log in the project directory.
You need to have Docker installed on your computer. Open the project directory in the terminal and enter the following 2 commands:

###### **docker build .**

The command "docker build ." is used to build a Docker image from a Dockerfile located in the current directory 

###### **docker-compose up**

The command "docker-compose up" is used to start and run a set of Docker containers as defined in a docker-compose.yml file. Docker Compose is a tool that allows you to define and manage multi-container applications.

The application will start at http://localhost:8080

For each task, there is a link to a page with the obtained results.
