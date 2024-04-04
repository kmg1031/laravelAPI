
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%; /* 버튼의 가로 길이를 100%로 설정 */
            background-color: #007bff;
            color: white;
            padding: 10px 0; /* 상하 패딩을 조정하여 버튼 높이를 일관되게 유지 */
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>

    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">ID:</label>
            <input type="text" id="id" name="id" required>
        </div>

        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button type="submit">Register</button>
    </form>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.querySelector("form");

        form.addEventListener("submit", function(e) {
            e.preventDefault(); // 폼의 기본 제출 이벤트를 방지

            const formData = new FormData(form);

            fetch("{{ route('users.store') }}", {
                method: "POST",
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest', // AJAX 요청임을 나타냄
                },
            })
            .then(response => {
                if (response.ok) {
                    return response.json(); // 응답을 JSON으로 변환
                }
                throw new Error('Network response was not ok.'); // 응답 실패 처리
            })
            .then(data => {
                if (data.result == 'success') {
                    window.location.href = "{{ route('login.index') }}"; // 로그인 페이지로 리다이렉트
                } else {
                    // 성공하지 않은 경우, 에러 메시지 처리
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('There has been a problem with your fetch operation:', error);
            });
        });
    });
    </script>
