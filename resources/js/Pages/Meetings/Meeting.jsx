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
import Page from '../Layouts/Page';
import { PencilIcon } from '@heroicons/react/24/outline'
import { router } from '@inertiajs/react';

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
        const safeUsers = Object.values(users) ?? [];
        
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
    
      const agendaOptions = agenda?.agenda_options[0] || {};

      return (
        <Page>
        <Card sx={{ mb: 3, boxShadow: 3 }}>
          <CardContent>
            <div className='flex justify-between w-full px-2 flex-wrap'>
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
            <div className='cursor-pointer p-2'
            onClick={() => {
                router.get(route('meetings.edit',  meeting?.id))
                console.log(meeting.id)
            }}
            >
            <PencilIcon className="h-5 w-5 text-gray-500" />
            </div>
            </div>
    
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
              <div className='flex gap-6 justify-start flex-wrap'>
              {renderVotingSection(
                'Проголосовали ЗА',
                agendaOptions?.agreed ?? [],
                <AgreedIcon color="success" />,
                'success'
              )}
    
              {renderVotingSection(
                'Проголосовали ПРОТИВ',
                agendaOptions?.against ?? [],
                <AgainstIcon color="error" />,
                'error'
              )}
    
              {renderVotingSection(
                'Воздержались',
                agendaOptions?.abstained ?? [],
                <AbstainedIcon color="warning" />,
                'warning'
              )}
              </div>
    
              {renderAttachments(agendaOptions?.attachments)}
            </Box>
          </CardContent>
        </Card>
        </Page>
      );
    }