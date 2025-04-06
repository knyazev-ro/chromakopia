import React from 'react';
import {
  Card,
  CardContent,
  Typography,
  Box,
  Stack,
  Chip,
  Divider,
  List,
  ListItem,
  ListItemAvatar,
  Avatar,
  ListItemText,
  Link,
  ButtonGroup,
  Button
} from '@mui/material';
import {
  CheckCircle as AgreedIcon,
  Block as AgainstIcon,
  PanTool as AbstainedIcon,
  Link as LinkIcon,
  Person as PersonIcon
} from '@mui/icons-material';

export default function Meeting({ meeting, agenda })
{
  const formatDate = (dateString) => {
    if (!dateString) return 'Дата не указана';
    const options = {
      day: 'numeric',
      month: 'long',
      year: 'numeric',
      hour: '2-digit',
      minute: '2-digit'
    };
    return new Date(dateString).toLocaleString('ru-RU', options);
  };
    
      const renderVotingSection = (title, users, icon, color) => {
        const safeUsers = Array.isArray(users) ? users : [];
        
        return (
          <Box sx={{ mb: 3 }}>
            <Typography variant="h6" sx={{ mb: 1, color }}>
              {icon} {title} ({safeUsers.length})
            </Typography>
            {safeUsers.length > 0 ? (
              <List dense>
                {safeUsers.map((user, index) => (
                  <ListItem key={index}>
                    <ListItemAvatar>
                      <Avatar sx={{ bgcolor: `${color}.main` }}>
                        <PersonIcon />
                      </Avatar>
                    </ListItemAvatar>
                    <ListItemText
                      primary={user?.name || 'Неизвестный пользователь'}
                      secondary={user?.email || 'Email не указан'}
                    />
                  </ListItem>
                ))}
              </List>
            ) : (
              <Typography variant="body2" color="text.secondary">
                Нет голосов
              </Typography>
            )}
          </Box>
        );
      };
    
      const renderAttachments = (attachments) => {
        const safeAttachments = Array.isArray(attachments) ? attachments : [];
        
        return (
          <Box sx={{ mt: 2 }}>
            <Typography variant="h6" sx={{ mb: 1 }}>
              <LinkIcon /> Вложения ({safeAttachments.length})
            </Typography>
            {safeAttachments.length > 0 ? (
              <ButtonGroup variant="outlined">
                {safeAttachments.map((url, index) => (
                  <Button
                    key={index}
                    component="a"
                    href={url}
                    target="_blank"
                    rel="noopener noreferrer"
                    startIcon={<LinkIcon />}
                  >
                    Вложение {index + 1}
                  </Button>
                ))}
              </ButtonGroup>
            ) : (
              <Typography variant="body2" color="text.secondary">
                Нет вложений
              </Typography>
            )}
          </Box>
        );
      };
    
      const agendaOptions = agenda?.agenda_options || {};
    
      return (
        <Card sx={{ mb: 3, boxShadow: 3 }}>
          <CardContent>
            <Box sx={{ display: 'flex', alignItems: 'center', gap: 2, mb: 3 }}>
              <Typography variant="h4" component="h1">
                {meeting?.name || 'Название собрания не указано'}
              </Typography>
              {meeting?.format_type_label && (
                <Chip 
                  label={meeting.format_type_label}
                  color="primary"
                  variant="outlined"
                />
              )}
            </Box>
    
            <Stack spacing={1} sx={{ mb: 3 }}>
              <Typography variant="subtitle1">
                <strong>Дата начала:</strong> {formatDate(meeting?.start_date)}
              </Typography>
              <Typography variant="subtitle1">
                <strong>Дата окончания:</strong> {formatDate(meeting?.end_date)}
              </Typography>
              <Typography variant="subtitle1">
                <strong>Председатель:</strong> {meeting?.chairman?.name || 'Не указан'}
              </Typography>
              <Typography variant="subtitle1">
                <strong>Секретарь:</strong> {meeting?.secretary?.name || 'Не указан'}
              </Typography>
            </Stack>
    
            <Divider sx={{ my: 3 }} />
    
            <Box sx={{ mb: 4 }}>
              {/* Исправленное отображение названия повестки */}
              <Typography variant="h5" gutterBottom>
                Повестка дня: {agenda?.name || 'Название повестки не указано'}
              </Typography>
    
              {renderVotingSection(
                'Проголосовали ЗА',
                agendaOptions?.agreed,
                <AgreedIcon color="success" />,
                'success'
              )}
    
              {renderVotingSection(
                'Проголосовали ПРОТИВ',
                agendaOptions?.against,
                <AgainstIcon color="error" />,
                'error'
              )}
    
              {renderVotingSection(
                'Воздержались',
                agendaOptions?.abstained,
                <AbstainedIcon color="warning" />,
                'warning'
              )}
    
              {renderAttachments(agendaOptions?.attachments)}
            </Box>
          </CardContent>
        </Card>
      );
    }