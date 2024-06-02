<a href="javascript:void()" class="chatbot-toggler" style="z-index: 9999999999;">
  <span style="font-size:x-large; color: #fff;
                position: absolute;"><i class="far fa-comment"></i></span>
  <span style="font-size:x-large; color: #fff;
                position: absolute;"><i class="fa fa-close"></i></span>
</a>

<div class="chatbot" style="z-index: 9999999999;">
  <div class="card-header" style="padding: 16px 0;
                position: relative;
                text-align: center;
                color: #fff;
                background: #40A2D8;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                ">
    <h2 class="mt-3 bold" style="font-size: 1.5rem;">HireUp Bot</h2>
    <span class="close-btn material-symbols-outlined" style="position: absolute;
                right: 15px;
                top: 50%;
                display: none;
                cursor: pointer;
                transform: translateY(-50%);">close</span>
  </div>
  <ul class="chatbox" style="overflow-y: auto;
                height: 510px;
                padding: 30px 20px 100px;
                z-index: 1;">
    <li class="chat incoming" style="display: flex;
                list-style: none;">
      <span class="material-symbols-outlined" style="width: 32px;
                height: 32px;
                color: #fff;
                cursor: default;
                text-align: center;
                line-height: 32px;
                align-self: flex-end;
                background: #40A2D8;
                border-radius: 4px;
                margin: 0 10px 7px 0;"><i class="fa fa-robot"></i></span>
      <p style="border-radius: 10px 10px 10px 0;">Hello! I'm HireUp Bot, your career companion. Let's navigate
        employment and recruitment together.</p>
    </li>
  </ul>
  <div class="chat-input" style="display: flex;
                gap: 5px;
                position: absolute;
                bottom: 0;
                width: 100%;
                background: #fff;
                padding: 12px 15px;
                border-top: 1px solid #ddd;">

    <p style="align-self: flex;
              color: #40A2D8;
              cursor: pointer;
              height: 55px;
              display: flex;
              align-items: center;
              font-size: 1.35rem;" id="plus-btn"><i class="fas fa-plus-circle"></i>
    </p>

    <textarea style="height: 55px !important;
                width: 100% !important;
                border: none !important;
                outline: none !important;
                resize: none !important;
                max-height: 100px !important;
                padding: 15px 15px 15px 0 !important;
                font-size: 0.95rem !important;
                text-transform: none;
                    resize: vertical;" id="textarea-bot" placeholder="Enter a message..." spellcheck="false" required>
    </textarea>
    <span style="align-self: flex;
                color: #40A2D8;
                cursor: pointer;
                height: 55px;
                display: flex;
                align-items: center;
                font-size: 1.35rem;" class="material-symbols-rounded mb-4"><i class="far fa-paper-plane"></i>
    </span>

    <p style="align-self: flex;
              color: #40A2D8;
              cursor: pointer;
              height: 55px;
              display: flex;
              align-items: center;
              font-size: 1.35rem;" id="mic-btn" onclick="startSpeechRecognition('textarea-bot')"><i
        class="fas fa-microphone"></i>
    </p>

  </div>
</div>

<script src="./../../../front office assets/js/chatbot.js"></script>

<script>
  function startSpeechRecognition(inputId) {
    if ('SpeechRecognition' in window || 'webkitSpeechRecognition' in window) {
      const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
      const recognition = new SpeechRecognition();
      recognition.interimResults = true;

      recognition.addEventListener('result', e => {
        const transcript = Array.from(e.results)
          .map(result => result[0])
          .map(result => result.transcript)
          .join('');

        document.getElementById(inputId).value = transcript;
      });

      recognition.addEventListener('end', () => {
        handleChat();
      });

      recognition.start();
    } else {
      alert("Speech recognition not supported in this browser.");
    }
  }

</script>

<div id="questionModal" class="modal"
  style="display:none; position: fixed; z-index: 10000000000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgb(0,0,0); background-color: rgba(0,0,0,0.4);">
  <div class="modal-content"
    style="background-color: #fefefe; margin: 15% auto; padding: 20px; border: 1px solid #888; width: 40%;">
    <span class="close" onclick="closeChatModal()"
      style="color: #aaa; float: left; font-size: 28px; font-weight: bold; cursor: pointer;">&times;</span>
    <h3>Costum</h3>
    <ul>
      <li class="question" style="cursor: pointer; color: #40A2D8;">Hello</li>
      <li class="question" style="cursor: pointer; color: #40A2D8;">List jobs</li>
      <li class="question" style="cursor: pointer; color: #40A2D8;">List notifications</li>
      <li class="question" style="cursor: pointer; color: #40A2D8;">Articles</li>
      <li class="question" style="cursor: pointer; color: #40A2D8;">Messaging</li>
      <li class="question" style="cursor: pointer; color: #40A2D8;">Reporting</li>
      <li class="question" style="cursor: pointer; color: #40A2D8;">Bye</li>
    </ul>

    <hr>

    <h3>Suggestion questions</h3>
    <ul id="suggestion-questions">
      <li class="question" style="cursor: pointer; color: #40A2D8;">What job opportunities are available?</li>
      <li class="question" style="cursor: pointer; color: #40A2D8;">How do I improve my resume?</li>
      <li class="question" style="cursor: pointer; color: #40A2D8;">What are the latest trends in the job market?</li>
    </ul>
  </div>
</div>


<script>
  // Show the modal when the plus button is clicked
  document.getElementById('plus-btn').onclick = function () {
    document.getElementById('questionModal').style.display = "block";
    
    // get some suggestions
    let sug_List = [];
    sug_List.push("How do I improve my resume?");
    sug_List.push("What are the latest trends in the job market?");
    sug_List.push("What are the fastest-growing industries for employment?");
    sug_List.push("How can I effectively network to enhance my job prospects?");
    sug_List.push("What skills are most in-demand by employers right now?");
    sug_List.push("How can I tailor my resume for a specific job application?");
    sug_List.push("Are there any emerging job roles that I should be aware of?");
    sug_List.push("What are some common mistakes to avoid during job interviews?");
    sug_List.push("Are there any certifications or additional training programs that could boost my career?");
    sug_List.push("What strategies can I use to negotiate a higher salary or better benefits?");

    function chooseRandomSuggestions(list, n) {
    let shuffled = list.slice(0), i = list.length, min = i - n, temp, index;
    while (i-- > min) {
        index = Math.floor((i + 1) * Math.random());
        temp = shuffled[index];
        shuffled[index] = shuffled[i];
        shuffled[i] = temp;
    }
    return shuffled.slice(min);
}


// Randomly choose 3 suggestions
let randomSuggestions = chooseRandomSuggestions(sug_List, 3);

// Get the <ul> element by its id
let ulElement = document.getElementById("suggestion-questions");

// Remove all child elements of the <ul> element
while (ulElement.firstChild) {
    ulElement.removeChild(ulElement.firstChild);
}

// Construct the HTML string for the list items
let htmlString = "";
randomSuggestions.forEach(suggestion => {
    htmlString += "<li class='question' style='cursor: pointer; color: #40A2D8;' onclick='LineClicked(this)'>" + suggestion + "</li>";
});

// Set the innerHTML of the <ul> element to the HTML string
ulElement.innerHTML = htmlString;





  }

  // Close the modal when the close button is clicked
  document.querySelector('.modal .close').onclick = function () {
    document.getElementById('questionModal').style.display = "none";
  }

  // Add event listeners to the questions to insert them into the chatbot's input
  document.querySelectorAll('.modal .question').forEach(function (question) {
    question.onclick = function () {
      document.getElementById('textarea-bot').value = this.textContent;
      handleChat();
      document.getElementById('questionModal').style.display = "none";
    }
  });

  // Close the modal when clicking outside of the modal content
  window.onclick = function (event) {
    if (event.target == document.getElementById('questionModal')) {
      document.getElementById('questionModal').style.display = "none";
    }
  }

  function LineClicked(qs) {
    console.log(qs);
    document.getElementById('textarea-bot').value = qs.textContent;
    handleChat();
    document.getElementById('questionModal').style.display = "none";
  }


  function closeChatModal() {
        var modal = document.getElementById("questionModal");
        modal.style.display = "none";
      }

</script>

<script src="https://code.responsivevoice.org/responsivevoice.js?key=TUGpBJay"></script>