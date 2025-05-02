
    // Global variables
    const totalAmount = 800;
  
    // DOM elements
    const progressSteps = document.querySelectorAll('.progress-step');
    const formSteps = document.querySelectorAll('.form-step');
    
    // Input validation patterns
    const patterns = {
      phone: /^[0-9]{10}$/,
      id: /^[0-9]{2}[A-Z]{2}[0-9]{2}\/[0-9]{3}$/
    };
    
    // Form validation functions
    function validateStep(stepNumber) {
      let isValid = true;
      const currentStep = document.getElementById('step' + stepNumber);
      const inputs = currentStep.querySelectorAll('input[required], select[required]');
      
      inputs.forEach(input => {
        // Skip validation for readonly fields
        if (input.readOnly) return;
        
        // Remove any existing error styling
        input.style.borderColor = '';
        input.parentElement.querySelector('label').style.color = '';
        
        // Check if empty
        if (!input.value.trim()) {
          input.style.borderColor = 'var(--danger)';
          input.parentElement.querySelector('label').style.color = 'var(--danger)';
          isValid = false;
        }
        
        // Special validation for phone number
        if (input.id === 'phone' && !patterns.phone.test(input.value)) {
          input.style.borderColor = 'var(--danger)';
          input.parentElement.querySelector('label').style.color = 'var(--danger)';
          showToast('Please enter a valid 10-digit phone number');
          isValid = false;
        }
        
        // Special validation for ID
        if (input.id === 'id' && !patterns.id.test(input.value)) {
          showToast('ID format should be like 05RS25/001');
          isValid = false;
        }
      });
      
      return isValid;
    }
    
    // Toast notification
    function showToast(message, type = 'error') {
      // Create toast element if it doesn't exist
      let toast = document.getElementById('toast');
      if (!toast) {
        toast = document.createElement('div');
        toast.id = 'toast';
        toast.style.cssText = `
          position: fixed;
          bottom: 20px;
          right: 20px;
          padding: 12px 24px;
          background: ${type === 'error' ? 'var(--danger)' : 'var(--success)'};
          color: white;
          border-radius: var(--radius);
          box-shadow: var(--shadow);
          opacity: 0;
          transition: var(--transition);
          z-index: 1000;
        `;
        document.body.appendChild(toast);
      }
      
      // Set message and show
      toast.textContent = message;
      toast.style.opacity = '1';
      
      // Auto hide after 3 seconds
      setTimeout(() => {
        toast.style.opacity = '0';
      }, 3000);
    }
    
    // Function to move to next step
    function nextStep(step) {
      // Validate current step before proceeding
      const currentStep = parseInt(step) - 1;
      if (currentStep > 0 && !validateStep(currentStep)) {
        return false;
      }
      
      // Remove active class from all steps
      formSteps.forEach(el => el.classList.remove('active'));
      progressSteps.forEach(el => el.classList.remove('active'));
      
      // Add active class to current step
      document.getElementById('step' + step).classList.add('active');
      document.getElementById('progressStep' + step).classList.add('active');
      
      // Mark previous steps as completed
      for(let i = 1; i < step; i++) {
        document.getElementById('progressStep' + i).classList.add('completed');
      }
      
      // Add animation classes
      document.getElementById('step' + step).style.animation = 'none';
      setTimeout(() => {
        document.getElementById('step' + step).style.animation = 'fadeSlideUp 0.5s forwards';
      }, 10);
      
      // Scroll to top of form
      window.scrollTo({
        top: document.querySelector('.container').offsetTop,
        behavior: 'smooth'
      });
    }
    
    // Function to go back to previous step
    function prevStep(step) {
      // Remove active class from all steps
      formSteps.forEach(el => el.classList.remove('active'));
      progressSteps.forEach(el => el.classList.remove('active'));
      
      // Add active class to previous step
      document.getElementById('step' + step).classList.add('active');
      document.getElementById('progressStep' + step).classList.add('active');
      
      // Mark previous steps as completed
      for(let i = 1; i < step; i++) {
        document.getElementById('progressStep' + i).classList.add('completed');
      }
      
      // Add animation classes
      document.getElementById('step' + step).style.animation = 'none';
      setTimeout(() => {
        document.getElementById('step' + step).style.animation = 'fadeSlideUp 0.5s forwards';
      }, 10);
    }
    
    // Function to close popup
    function closePopup() {
      document.getElementById('successPopup').classList.remove('show');
    }
    
    // Calculate age from DOB
    document.getElementById("dob").addEventListener("change", function() {
      const dob = new Date(this.value);
      const today = new Date();
      let age = today.getFullYear() - dob.getFullYear();
      if (today.getMonth() < dob.getMonth() || 
          (today.getMonth() === dob.getMonth() && today.getDate() < dob.getDate())) {
        age--;
      }
      document.getElementById("age").value = age;
    });
    
    // Calculate Gold UMS date (3 days after trial)
    document.getElementById("trialDate").addEventListener("change", function() {
      const trial = new Date(this.value);
      if (!isNaN(trial)) {
        trial.setDate(trial.getDate() + 3);
        document.getElementById("goldUMS").value = trial.toISOString().split("T")[0];
      }
    });
    
    // Update amount due based on paid amount
    function updateAmountDue() {
      const amountPaid = parseFloat(document.getElementById("amountPaid").value) || 0;
      const amountDue = totalAmount - amountPaid;
      document.getElementById("amountDue").value = "₹" + amountDue;
    }
    
    // Calculate BMI when height and weight are entered
    document.getElementById("height").addEventListener("input", calculateBMIAndStats);
    document.getElementById("weight").addEventListener("input", calculateBMIAndStats);
    
    function calculateBMIAndStats() {
      const height = parseFloat(document.getElementById("height").value) || 0;
      const weight = parseFloat(document.getElementById("weight").value) || 0;
      
      if (height > 0 && weight > 0) {
        // BMI = weight(kg) / (height(m))²
        const heightInMeters = height / 100;
        const bmi = weight / (heightInMeters * heightInMeters);
        document.getElementById("bmi").value = bmi.toFixed(1);
        
        // Auto-calculate estimated body fat percentage based on BMI
        // This is just an estimation formula
        const gender = document.getElementById("gender").value;
        const age = parseInt(document.getElementById("age").value) || 25;
        
        if (gender && age) {
          let bodyFat = 0;
          if (gender === "Male") {
            bodyFat = (1.20 * bmi) + (0.23 * age) - 16.2;
          } else if (gender === "Female") {
            bodyFat = (1.20 * bmi) + (0.23 * age) - 5.4;
          } else {
            bodyFat = (1.20 * bmi) + (0.23 * age) - 10.8; // Average for other
          }
          
          // Ensure reasonable range
          bodyFat = Math.max(5, Math.min(bodyFat, 50));
          document.getElementById("bodyFat").value = bodyFat.toFixed(1);
          
          // Set estimated body age based on BMI and actual age
          let bodyAge = age;
          if (bmi < 18.5) bodyAge = age + 2;
          else if (bmi < 25) bodyAge = age - 3;
          else if (bmi < 30) bodyAge = age + 1;
          else bodyAge = age + 5;
          
          document.getElementById("bodyAge").value = Math.max(18, bodyAge);
        }
      }
    }
    
    // Add animated focus effect to form fields
    document.querySelectorAll('.form-control').forEach(input => {
      input.addEventListener('focus', function() {
        this.parentElement.querySelector('.focus-indicator').style.transform = 'scaleX(1)';
      });
      
      input.addEventListener('blur', function() {
        this.parentElement.querySelector('.focus-indicator').style.transform = 'scaleX(0)';
      });
    });
    
    // Allow clicking on progress steps to navigate (only if previous steps are complete)
    progressSteps.forEach(step => {
      step.addEventListener('click', function() {
        const stepNum = parseInt(this.getAttribute('id').replace('progressStep', ''));
        const currentActive = parseInt(document.querySelector('.form-step.active').getAttribute('id').replace('step', ''));
        
        // Only allow navigation to previous steps or next step if current step is valid
        if (stepNum < currentActive || (stepNum === currentActive + 1 && validateStep(currentActive))) {
          nextStep(stepNum);
        }
      });
    });
    
    // Form submission
    document.getElementById("registrationForm").addEventListener("submit", function(e) {
      e.preventDefault();
      
      // Final validation
      if (!validateStep(3)) {
        return false;
      }
      
      // Generate summary with animation
      const summaryContent = document.getElementById("summaryContent");
      summaryContent.innerHTML = "";
      
      // Create animation effect for each row
      setTimeout(() => {
        const summaryHTML = `
        <div class="summary-row">
          <div class="summary-label">Name:</div>
          <div class="summary-value">${document.getElementById("name").value}</div>
        </div>
        <div class="summary-row">
          <div class="summary-label">Gender:</div>
          <div class="summary-value">${document.getElementById("gender").value}</div>
        </div>
        <div class="summary-row">
          <div class="summary-label">Date of Birth:</div>
          <div class="summary-value">${document.getElementById("dob").value}</div>
        </div>
        <div class="summary-row">
          <div class="summary-label">Age:</div>
          <div class="summary-value">${document.getElementById("age").value} years</div>
        </div>
        <div class="summary-row">
          <div class="summary-label">Phone:</div>
          <div class="summary-value">${document.getElementById("phone").value}</div>
        </div>
        <div class="summary-row">
          <div class="summary-label">Coach:</div>
          <div class="summary-value">${document.getElementById("coach").value}</div>
        </div>
        <div class="summary-row">
          <div class="summary-label">Height:</div>
          <div class="summary-value">${document.getElementById("height").value} cm</div>
        </div>
        <div class="summary-row">
          <div class="summary-label">Weight:</div>
          <div class="summary-value">${document.getElementById("weight").value} kg</div>
        </div>
        <div class="summary-row">
          <div class="summary-label">BMI:</div>
          <div class="summary-value">${document.getElementById("bmi").value}</div>
        </div>
        <div class="summary-row">
          <div class="summary-label">Body Fat:</div>
          <div class="summary-value">${document.getElementById("bodyFat").value}%</div>
        </div>
        <div class="summary-row">
          <div class="summary-label">Body Age:</div>
          <div class="summary-value">${document.getElementById("bodyAge").value} years</div>
        </div>
        <div class="summary-row">
          <div class="summary-label">Payment Type:</div>
          <div class="summary-value">${document.getElementById("paymentType").value}</div>
        </div>
        <div class="summary-row">
          <div class="summary-label">Amount Paid:</div>
          <div class="summary-value">₹${document.getElementById("amountPaid").value}</div>
        </div>
        <div class="summary-row">
          <div class="summary-label">Amount Due:</div>
          <div class="summary-value">${document.getElementById("amountDue").value}</div>
        </div>
        `;
        
        // Split summary into parts and animate each row
        const rows = summaryHTML.split('<div class="summary-row">');
        rows.forEach((row, i) => {
          if (!row.trim()) return;
          
          const div = document.createElement('div');
          div.className = 'summary-row';
          div.innerHTML = row;
          div.style.opacity = '0';
          div.style.transform = 'translateY(20px)';
          div.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
          
          summaryContent.appendChild(div);
          
          // Staggered animation
          setTimeout(() => {
            div.style.opacity = '1';
            div.style.transform = 'translateY(0)';
          }, i * 100);
        });
      }, 300); // Wait for transition to complete
      
      // Show step 4
      nextStep(4);
      
      // Show success popup after a delay
      setTimeout(() => {
        document.getElementById('successPopup').classList.add('show');
      }, 1500);
    // Apply floating label effect to all inputs on page load
    document.addEventListener('DOMContentLoaded', function() {
      // Initialize field with random ID number
      const today = new Date();
      const year = today.getFullYear().toString().slice(-2);
      const month = (today.getMonth() + 1).toString().padStart(2, '0');
      const randomNum = Math.floor(Math.random() * 999).toString().padStart(3, '0');
      document.getElementById('id').value = month + 'RS' + year + '/' + randomNum;
      // Add subtle reveal animation to header elements
      const headerElements = document.querySelectorAll('.header > *');
      headerElements.forEach((el, i) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
        
        setTimeout(() => {
          el.style.opacity = '1';
          el.style.transform = 'translateY(0)';
        }, 100 + (i * 200));
      });
      
      // Add reveal animation to progress steps
      progressSteps.forEach((step, i) => {
        step.style.opacity = '0';
        step.style.transform = 'translateY(10px)';
        step.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
        
        setTimeout(() => {
          step.style.opacity = '1';
          step.style.transform = 'translateY(0)';
        }, 500 + (i * 150));
      });
    });
