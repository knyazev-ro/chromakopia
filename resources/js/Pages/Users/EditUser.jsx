import { useForm } from '@inertiajs/react';
import {
  TextField,
  Button,
  Typography,
  Box,
  Paper,
  Grid,
  InputAdornment
} from '@mui/material';
import LockIcon from '@mui/icons-material/Lock';
import EmailIcon from '@mui/icons-material/Email';
import AccountCircle from '@mui/icons-material/AccountCircle';

export default function EditUser({ user, branches, roles }) {
  const { data, setData, put, processing, errors } = useForm({
    name: user?.name || '',
    email: user?.email || '',
    password: '',
    branch_id: user?.branch_id || '',
    sign: user?.sign || '',
  });

  const handleSubmit = (e) => {
    e.preventDefault();
    put(route('users.update', user.id));
  };

  return (
    <Box className="p-6" maxWidth="600px" mx="auto">
      <Paper elevation={4} className="p-6 bg-blue-500 text-white rounded-2xl shadow-md">
        <Typography variant="h5" gutterBottom className="font-bold">
          Редактирование пользователя
        </Typography>
        <form onSubmit={handleSubmit}>
          <Grid container spacing={3}>
            <Grid item xs={12}>
              <TextField
                fullWidth
                label="Имя"
                value={data.name}
                onChange={(e) => setData('name', e.target.value)}
                error={!!errors.name}
                helperText={errors.name}
                InputProps={{
                  startAdornment: (
                    <InputAdornment position="start">
                      <AccountCircle />
                    </InputAdornment>
                  ),
                }}
                variant="outlined"
              />
            </Grid>

            <Grid item xs={12}>
              <TextField
                fullWidth
                label="Email"
                value={data.email}
                onChange={(e) => setData('email', e.target.value)}
                error={!!errors.email}
                helperText={errors.email}
                InputProps={{
                  startAdornment: (
                    <InputAdornment position="start">
                      <EmailIcon />
                    </InputAdornment>
                  ),
                }}
                variant="outlined"
              />
            </Grid>

            <Grid item xs={12}>
              <TextField
                fullWidth
                label="Новый пароль"
                type="password"
                value={data.password}
                onChange={(e) => setData('password', e.target.value)}
                error={!!errors.password}
                helperText={errors.password || 'Оставьте пустым, чтобы не менять пароль'}
                InputProps={{
                  startAdornment: (
                    <InputAdornment position="start">
                      <LockIcon />
                    </InputAdornment>
                  ),
                }}
                variant="outlined"
              />
            </Grid>

            <Grid item xs={12}>
              <TextField
                fullWidth
                label="Филиал (branch_id)"
                value={data.branch_id}
                onChange={(e) => setData('branch_id', e.target.value)}
                error={!!errors.branch_id}
                helperText={errors.branch_id}
                variant="outlined"
              />
            </Grid>

            <Grid item xs={12}>
              <TextField
                fullWidth
                label="Подпись (sign)"
                value={data.sign}
                onChange={(e) => setData('sign', e.target.value)}
                error={!!errors.sign}
                helperText={errors.sign}
                variant="outlined"
              />
            </Grid>

            <Grid item xs={12}>
              <Button
                type="submit"
                variant="contained"
                color="secondary"
                disabled={processing}
                fullWidth
                className="mt-4 bg-white text-blue-500 font-bold hover:bg-blue-100"
              >
                Сохранить изменения
              </Button>
            </Grid>
          </Grid>
        </form>
      </Paper>
    </Box>
  );
}
