      </section>
    </div>
    <footer>
      <?php foreach($web_page_rows as $web_page_row): ?>
        <a href="index.php?permalink=<?= $web_page_row["permalink"]; ?>"><?= $web_page_row["title"]; ?></a> | 
      <?php endforeach; ?><a href="news.php">News</a> | <a href="student_application.php">Student</a>/<a href="teacher_application.php">Teacher</a> Application<br />
      &copy; <?= date("Y"); ?> Custom Music Lessons &#8226; Designed by <a href="mailto:jwilliams42@academic.rrc.ca">Jamie Williams</a>
    </footer>
  </div>
</body>
</html>
