<h1>Users List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Code</th>
      <th>Name</th>
      <th>Password</th>
      <th>Email</th>
      <th>Date</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($users as $user): ?>
    <tr>
      <td><a href="<?php echo url_for('user/edit?id='.$user->getId()) ?>"><?php echo $user->getId() ?></a></td>
      <td><?php echo $user->getCode() ?></td>
      <td><?php echo $user->getName() ?></td>
      <td><?php echo $user->getPassword() ?></td>
      <td><?php echo $user->getEmail() ?></td>
      <td><?php echo $user->getDate() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('user/new') ?>">New</a>
