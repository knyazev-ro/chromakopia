import { useForm } from '@inertiajs/react';
import {
  TextField,
  Button,
  Typography,
  Box,
  Paper,
  Grid,
  InputAdornment,
  Select,
  MenuItem,
  FormControl,
  InputLabel,
  Avatar
} from '@mui/material';
import LockIcon from '@mui/icons-material/Lock';
import EmailIcon from '@mui/icons-material/Email';
import AccountCircle from '@mui/icons-material/AccountCircle';
import PersonIcon from '@mui/icons-material/Person';
import Page from '../Layouts/Page';

export default function EditUser({ user, branches, roles }) {
  const { data, setData, put, processing, errors } = useForm({
    name: user?.name || '',
    email: user?.email || '',
    password: '',
    branch_id: user?.branch_id || '',
    sign: user?.sign || '',
    role_id: user?.role_id || '',
    avatar: null,
  });

  const handleSubmit = (e) => {
    e.preventDefault();
    put(route('users.update', user.id), {
      forceFormData: true, // Для загрузки файлов
    });
  };

  const handleFileUpload = (e) => {
    setData('avatar', e.target.files[0]);
  };

  return (
    <Page>
    <Box className="p-6" maxWidth="600px" mx="auto">
      <Paper elevation={4} className="p-6 bg-gradient-to-br from-blue-600 to-blue-400 text-white rounded-2xl shadow-md">
        <Typography variant="h5" gutterBottom className="font-bold mb-4">
          Редактирование пользователя
        </Typography>
        
        {/* Аватарка */}
        <Box display="flex" justifyContent="center" mb={3}>
          <label htmlFor="avatar-upload">
            <Avatar
              src={data.avatar ? URL.createObjectURL(data.avatar) : user?.avatar_url}
              sx={{ 
                width: 100, 
                height: 100, 
                cursor: 'pointer',
                border: '2px solid white'
              }}
            >
              <PersonIcon fontSize="large" />
            </Avatar>
            <input
              type="file"
              id="avatar-upload"
              hidden
              accept="image/*"
              onChange={handleFileUpload}
            />
          </label>
        </Box>

        <form onSubmit={handleSubmit} encType="multipart/form-data">
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
              <FormControl fullWidth>
                <InputLabel>Тип пользователя</InputLabel>
                <Select
                  value={data.role_id}
                  onChange={(e) => setData('role_id', e.target.value)}
                  label="Тип пользователя"
                  variant="outlined"
                >
                  {roles.map((role) => (
                    <MenuItem key={role.id} value={role.id}>
                      {role.name}
                    </MenuItem>
                  ))}
                </Select>
              </FormControl>
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
                sx={{
                  mt: 2,
                  bgcolor: 'white',
                  color: 'blue.600',
                  fontWeight: 'bold',
                  '&:hover': { bgcolor: 'blue.50' }
                }}
              >
                Сохранить изменения
              </Button>
            </Grid>
          </Grid>
        </form>
      </Paper>
    </Box>
    </Page>
  );
}